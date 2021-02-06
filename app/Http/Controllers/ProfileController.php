<?php

namespace App\Http\Controllers;

use App\User;
use App\TabunganUser;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function profileUser($user_id)
    {
        $user = User::findOrFail($user_id);

        $role = $user->roles()->first()->name;

        switch ($role) {
            case $role == 'nasabah' :
                $tabungan = $this->tabunganNasabah($user->id);
                return view("user.{$role}.profile")->with(compact('user', 'role', 'tabungan'));
        
            case $role == 'pengurus-satu' :
                return view("user.{$role}.profile")->with(compact('user', 'role'));
            case $role == 'pengurus-dua' :
                return view("user.{$role}.profile")->with(compact('user', 'role'));
            case $role == 'bendahara' :
                return view("user.{$role}.profile")->with(compact('user', 'role'));
        }
    }

    public function tabunganNasabah($user_id) 
    {
        $tabungan = TabunganUser::where('nasabah_id', $user_id)->get();

        return $tabungan;
    }
}
