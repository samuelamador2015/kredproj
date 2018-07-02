<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

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
    		'category'  => 'required',
    		'course'  => 'required',
    		'studid' => 'required',
    		'teacher' => 'required',
    		'details' => 'required|max:1000' ,
    		//'file' => 'image|mimes:jpeg,bmp,png,zip,html|size:30000'
    	],[
    		'studid.required' => 'Please Select name of Student' 
    	]); 

    	\App\Activity::create([
    		'stud_id' => $request->studid,
    		'course_id' => $request->course,
    		'act_name' => $request->activity_name,
    		'details' => $request->details,
    		'file_path' => $request->file,
    		'link' => $request->link,
    		'user_id' => Auth::user()->id,
    		'activity_category' => $request->category,
    	]);
    	return redirect()->route('activity')
    			->with('success', 'Successfully added new Activity');
    }

    /* POST Ajax
     */
    public function item(Request $request)
    {	 
        $data = DB::table('activities')
              ->selectRaw('users.name AS stud_name, activities.id AS act_id, course_id, file_path, link, activity_category, act_name, courses.title AS title, courses.category as course_cat, activities.created_at AS created, details')
              ->join('courses', 'courses.id', '=', 'activities.course_id')
        	  ->join('users', 'users.id', '=', 'activities.stud_id')
              ->where('activities.id', '=' ,  $request->id)
              ->get();
        return  $data->toJSON();
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'me';
    }


    public function destroy($id)
    {

    }
}
