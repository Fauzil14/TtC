<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Auth\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class NasabahController extends Controller
{
    
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired']);

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid']);

        } catch (JWTException $e) {

            return response()->json(['token_absent']);

        }

        $user = new UserResource($user);
        
        try {
            return $this->sendResponse('succes', 'User data succesfully obtained', $user, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'User data failed to get', null, 500);
        }
    }

    
}
