<?php

namespace App\Http\Controllers\Api\Nasabah;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

        $role_name = $user->roles()->first()->role_name;
        $role = [ 'role' => $role_name ];
        $user = array_merge($user->toArray(), $role);
        
        try {
            return $this->sendResponse('succes', 'User data succesfully obtained', $user, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'User data failed to get', null, 500);
        }
    }

    public function updateProfileNasabah(Request $request, Client $client) 
    {
        $authUser = User::find(Auth::id());

        $request->validate([
            'name'            => ['string'],
            'email'           => [ 
                                    'email', 
                                    Rule::unique('users')->ignore($authUser->id),
                                 ],
            'no_telephone'    => [
                                    Rule::unique('users')->ignore($authUser->id),
                                 ],
            // 'location' => '',
            'profile_picture' => ['image', 'max:2048', 'mimes:jpg,jpeg,png'],
        ]);

        if(!empty($request->profile_picture)) {
            $image = base64_encode(file_get_contents($request->profile_picture));

            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $image,
                    'format' => 'json'
                ]
            ]);

            $content = $response->getBody()->getContents();
            
            $pp = json_decode($content);
            $pp = $pp->image->display_url;
        } else {
            $pp = $authUser->profile_picture;
        }

        // forget = The forget method removes an item from the collection by its key
        $request = collect($request->toArray())->forget('profile_picture');

        if($request->has('_method')) {
            $request = $request->forget('_method');
        }
    
        $request->each(function($item, $key) use ($authUser) {
            $authUser->{$key} = $item;
        });
        $authUser->profile_picture = $pp;
        $authUser->update();

        try {
            return $this->sendResponse('succes', 'User data has been succesfully updated', $authUser, 200);
        } catch(\Throwable $e) {
            return $this->sendResponse('failed', 'User data failed to update', null, 500);
        }
    }

}
