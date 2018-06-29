<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    { 
        $acts = DB::table('activities')->paginate(2);
        
    	return view('activity.index', compact('acts'));
    }

    public function create()
    {
    	$courses = \App\Course::all();
    	return view('activity.create', compact('courses'));
    }

    /* POST
     */
    public function store(Request $request)
    {
    	/*$this->validate($request, [
    		'activity_name' => 'required',
    		'category'  => 'required',
    		'course'  => 'required',
    		'student' => 'required',
    		'teacher' => 'required',
    		'details' => 'required' ,
    		'file' => 'image|mimes:jpeg,bmp,png,zip|size:10000'
    	]);*/

    	\App\Activity::create([
    		'stud_name' => $request->student,
    		'course_id' => $request->course,
    		'act_name' => $request->activity_name,
    		'details' => $request->details,
    		'file_path' => $request->file,
    		'link' => $request->link,
    		'activity_category' => $request->category,
    		'user_id' => Auth::user()->id
    	]);
    	return "saved";
    }

    public function item(Request $request){
    	return 'hallow';
    }
}
