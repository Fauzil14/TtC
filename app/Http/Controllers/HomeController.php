<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Role::whereHas('users', function($q) {
            return $q->where('users.id', Auth::user()->id);
        })->get();

        $roles = Role::all();
        $message = "this page is for treasurer";

        return view('test')->with(compact(['role', 'roles', 'message']));
    }

}
