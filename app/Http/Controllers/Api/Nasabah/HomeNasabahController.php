<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeNasabahController extends Controller
{
    public function index() {
        return response()->json([
            'current_user' => auth()->user(),
            'message' => "This page is accessable by nasabah"
        ]);
    }
}
