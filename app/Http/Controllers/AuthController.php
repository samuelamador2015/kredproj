<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
	/* @GET
	*/
	public function loginForm()
	{
		return view('auth.login');
	}

	/* @POST 
	 */
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
        ]);
        if (Auth::attempt([
        	'email' => $request->email, 
        	'password' => $request->password])
        ){ 
        	return redirect('/');
       }
        return redirect('/login')->with('error', 'Invalid Email address or Password');
    }

    /*
    */
    public function register()
    {
    	return view('auth.register');
    }

    /*
     */
    public function registerUser(Request $request)
    {  
        $this->validate($request, [
        	'name' => 'required', 
            'email' => 'required|email|unique:users|max:255', 
            'password' => 'required|confirmed|max:255',
        ]);

        $user_create = User::create([
            'password'   => bcrypt($request->password),
            'email'      => $request->email,
            'name'       => $request->name,  
            'role'       => 'student'
        ]); 

        return "created";
    }

    /* GET
     */
    public function logout(Request $request)
    {
        if(Auth::check())
        { 
            Auth::logout(); 
            $request->session()->invalidate();
        } 
        return  redirect('/login');
    }
}
