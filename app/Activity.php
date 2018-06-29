<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 

class Activity extends Model
{
    protected $fillable = ['stud_name', 'course_id', 'act_name', 'details',
		'file_path', 'link', 'activity_category'];
}
