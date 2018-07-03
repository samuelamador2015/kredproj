<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {    
        $acts = DB::table('activities')
        		->selectRaw('activities.id AS act_id, act_name, activity_category, users.name AS stud_name, courses.title AS course_title')
        		->join('users', 'users.id', '=', 'activities.stud_id')
        		->join('courses', 'courses.id', '=', 'course_id')
        		->orderby('act_id', 'DESC')
        		->paginate(3);
        
    	return view('activity.index', compact('acts'));
    }

    public function create()
    { 
    	$courses  = \App\Course::all();
    	$students = DB::table('users')
    				->where('role', '=', 'student')
    				->orderby('id', 'DESC')
    				->limit(5)
    				->get(); 
    	return view('activity.create', ['courses'=> $courses, 
    					'students' => $students ]);
    }

    /* POST
     */
    public function store(Request $request)
    { 
    	$this->validate($request, [
    		'activity_name' => 'required',
    		'category'=> 'required',
    		'course'  => 'required',
    		'studid'  => 'required',
    		'teacher' => 'required',
    		'details' => 'required|max:3000' ,
    		'photo'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	 	'file'    => 'mimes:jpeg,bmp,png,zip,rar,html,pdf|max:50000' 
    	],[
    		'studid.required' => 'Please Select name of Student' 
    	]); 

    	$photo = $this->uploadPhoto($request);
    	$file  = $this->uploadFile($request); 

    	\App\Activity::create([
    		'stud_id'    => $request->studid,
    		'course_id'  => $request->course,
    		'act_name'   => $request->activity_name,
    		'details'    => $request->details,
    		'file_path'  => $file->path, 
    		'file_size'  => $file->size, 
    		'photo_path' => $photo->path,
    		'photo_size' => $photo->size,
    		'user_id'    => Auth::user()->id,
    		'activity_category' => $request->category,
    		'token'      => str_random(40)
    	]);
    	return redirect()->route('activity')
    			->with('success', 'Successfully added new Activity');
    }

    /* Upload Photo
     */
    public function uploadPhoto($request)
    {   
    	$photo = ['path' => '', 'size' => ''];
    	if(isset($request->photo)){ 
	    	$photo = array(
	    		'path' => str_random(30) . '.'. $request->photo->getClientOriginalExtension(),
	    		'size' => $request->photo->getClientSize()
	    	);
       	 	$request->photo->move(public_path('images'), $photo['path']);
    	}   
        return (object) $photo;
    }

    /* Upload File
     */
    public function uploadFile($request)
    {   
    	$file = ['path' => '', 'size' => ''];
    	if(isset($request->file)){ 
	    	$file = array(
	    		'path' => str_random(30).'.'.$request->file->getClientOriginalExtension(),
	    		'size' => $request->file->getClientSize()
	    	);
       	 	$request->file->move(public_path('uploads'), $file['path']);
	    }
        return (object) $file;
    }

    /* POST Ajax  
    	$created = Carbon::createFromFormat('Y-m-d H:i:s', $json->created)->diffForHumans();
     */
    public function item(Request $request)
    {	 
        $json = DB::table('activities')
              ->selectRaw('users.name AS stud_name, activities.id AS act_id, course_id, file_path, photo_path, activity_category, act_name, courses.title AS title, courses.category as course_cat, activities.created_at AS created, details, token')
              ->join('courses', 'courses.id', '=', 'activities.course_id')
        	  ->join('users', 'users.id', '=', 'activities.stud_id')
              ->where('activities.id', '=' , $request->id)
              ->first(); 

		$created = date('F d, Y H:i:s', strtotime($json->created));
		$photo = ($json->photo_path) ? asset('images/'. $json->photo_path) : '';
        $data = array(
        	'act_id'     => $json->act_id,
        	'stud_name'  => $json->stud_name,
        	'act_name'   => $json->act_name,
        	'created'    => $created,
        	'photo_path' => $photo,
        	'file_path'  => $json->file_path,
        	'details'    => nl2br($json->details),
        	'token'      => $json->token
        );
        
        return  $data;
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return str_random(40);
    }


    public function destroy($id)
    {

    }

    /* POST search AJAX
     */
    public function ajaxSearch(Request $request)
    {  
    	$data = DB::table('users')
    			->selectRaw('id, email, name, role')
    			->where('name','like','%'. $request->input .'%')
    			->limit(5)
    			->get();
    	return $data;
    }

    public function downloadFile(Request $request)
    {
    	$data = DB::table('activities')
    			->selectRaw('file_path')
    			->where('token', '=', $request->token)
    			->where('file_path', '!=' , ''); 
    	if( $data->count() > 0){ 
    		$data = $data->first();
		    $path = public_path("uploads/". $data->file_path);
		    return response()->download($path); 
    	}
    	return redirect()->route('activity');
    }
}
