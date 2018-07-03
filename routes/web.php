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
  

Route::resource('/courses' , 'CourseController');



Route::prefix('activities')->group(function(){ 
	
	Route::get('/', 'ActivityController@index')
			->name('activity')->middleware('auth');

	Route::post('/item', 'ActivityController@item' ) 
			->name('post_item')->middleware('auth');

	Route::post('/ajax-search', 'ActivityController@ajaxSearch')->middleware('auth');

	Route::post('/create', 'ActivityController@store' )->middleware('auth');
	Route::get('/create', 'ActivityController@create' ) 
			->name('create_activity')->middleware('auth');

	Route::get('/edit/{slug}', 'ActivityController@edit' )->middleware('auth');
	Route::get('/download', 'ActivityController@downloadFile')->middleware('auth');
});


/* Not implemented below */

Route::prefix('student')->group(function(){ 
	
	Route::get('/', 'EmployersAuthController@logincheck');
});
