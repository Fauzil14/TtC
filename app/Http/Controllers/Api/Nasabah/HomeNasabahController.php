<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeNasabahController extends Controller
{
    public function index() {
        $user = User::where('id', Auth::id())->with(['tabunganUser' => function($query) {
            $query->orderBy('id', 'desc');
        }])->get();
        
        return response($user);
        
        return response()->json([
            'current_user' => auth()->user(),
            'message' => "This page is accessable by nasabah"
        ]);
    }
}
