<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');
 

Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->name('logout');


Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@registerUser');
   

Route::prefix('student')->group(function(){ 
	
	Route::get('/', 'EmployersAuthController@logincheck');
});


Route::resource('/courses' , 'CourseController');