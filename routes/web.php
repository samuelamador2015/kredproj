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
    return view('welcome');
})->middleware('auth');


Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login');

Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@registerUser');
  

Route::prefix('employers')->group(function(){ 
	
	Route::get('/', 'EmployersAuthController@logincheck');
});