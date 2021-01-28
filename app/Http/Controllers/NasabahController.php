<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    
    public function index(User $user)
    {
        $nasabahs = $user->whoHasRole('nasabah')->get();
        
        return view('nasabah.index')->with(compact('nasabahs'));
    }
}
