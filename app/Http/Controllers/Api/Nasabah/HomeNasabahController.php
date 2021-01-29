<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use Illuminate\Support\Facades\Auth;

class HomeNasabahController extends Controller
{
    public function index() {
        $user = User::findOrFail(Auth::id());

        $user = new HomeResource($user);

        return response()->json($user);
    }
    
}
