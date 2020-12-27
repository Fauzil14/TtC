<?php

namespace App\Http\Controllers\Api\PengurusDua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePengurusDuaController extends Controller
{
    public function index() {
        return response()->json([
            'current_user' => auth()->user(),
            'message' => "This page is accessable by pengurus dua"
        ]);
    }
}
