<?php

namespace App\Http\Controllers\Api;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request, User $user)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = $user->firstWhere('email', $request->email);
        $name = $user->roles()->first()->name;
        $role = [ 'role' => $name ];
        $user = array_merge($user->toArray(), $role);

        return response()->json(compact('user', 'token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        
        $nasabahRole = Role::where('name', 'nasabah')->first();
        $user->roles()->attach($nasabahRole);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

   
}
