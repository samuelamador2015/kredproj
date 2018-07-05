<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function index()
    {   
        $data = \DB::table('users')->paginate(10);
        return view('auth.list', compact('data'));
    }

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
            'role'  => 'required'
        ]);

        $user_create = User::create([
            'password'   => bcrypt($request->password),
            'email'      => $request->email,
            'name'       => $request->name,  
            'role'       => $request->role
        ]); 

        return redirect()->route('users');
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
