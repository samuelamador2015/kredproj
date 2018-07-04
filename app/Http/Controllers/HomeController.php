<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /*public function searchUsers(Request $request)
    {
        $search = explode(',' , $request->q);
        $index  = count($search) - 1;   
        return User::where('name', 'LIKE', '%'. trim($search[$index]).'%')
                ->limit(5)
                ->get();
    }*/
}
