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

Route::get('/', function(){
	return view('client.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');
 

Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->name('logout');


Route::prefix('users')->group(function(){ 
	Route::get('/add', 'AuthController@register')->name('register')->middleware('auth');
	Route::post('/add', 'AuthController@registerUser');
	Route::get('/', 'AuthController@index')->name('users');
});

Route::resource('/courses' , 'CourseController');
 

/* activities
 */
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

	Route::post('/delete', 'ActivityController@deleteActivity')->middleware('auth')
		   ->name('activity_destroy');
	Route::post('/front', 'ActivityController@front')->middleware('auth')->name('activity_front');
});

 