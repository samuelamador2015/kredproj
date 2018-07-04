<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stud_id'); //connect the student
            $table->integer('course_id');
            $table->string('act_name');
            $table->string('tags')->nullable();
            $table->text('details');
            $table->string('file_path')->nullable(); 
            $table->string('file_size')->nullable(); 
            $table->string('photo_path')->nullable(); 
            $table->string('photo_size')->nullable(); 
            $table->integer('front_display')->default(0); //1 - display in front 
            $table->string('activity_category');
            $table->integer('user_id'); //user who uploaded
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
