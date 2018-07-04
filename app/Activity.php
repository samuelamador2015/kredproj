<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 

class Activity extends Model
{
    protected $fillable = ['stud_id', 'course_id', 'act_name', 'details', 'tags',
		'file_path', 'file_size', 'photo_path', 'photo_size', 'front_display' ,
		'activity_category', 'user_id', 'token'];
}
 