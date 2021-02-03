<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function indexUser($role, User $user)
    {
        ${$role} = $user->whoHasRole("{$role}")->get();

        switch ($role) {
            case $role == 'pengurus-satu' :
                return view("user.{$role}.index")->with(["pengurus_satus" => ${$role}]);
                break;
            case $role == 'pengurus-dua' :
                return view("user.{$role}.index")->with(["pengurus_duas" => ${$role}]);
                break;
            default :
                return view("user.{$role}.index")->with(["{$role}s" => ${$role}]);
        }
    }

    public function delete($user_id)
    {

        $user = User::findOrFail($user_id);
        $role = $user->roles()->first()->name;
        
        try {
            $user->delete();
    
            Alert::success('Berhasil', 'Data ' . $role . ' berhasil di hapus');
            return back();
        } catch(\Throwable $e) {
            Alert::error('Gagal', 'Data ' . $role . ' gagal di hapus');
        }
    }

    public function show($user_id)
    {
        User::findOrFail($user_id);
    }

    public function tambahUser(Request $request, Client $client) 
    {

        $validatedData = $request->validateWithBag('tambah', [
            'name'            => [ 'required' ,'string'],
            'email'           => [ 'required' ,'email', Rule::unique('users')],
            'password'        => [ 'required', 'min:6' ],
            'no_telephone'    => [ 'required', Rule::unique('users') ],
            'location'        => [ 'required' ],
            'profile_picture' => [ 'image', 'max:2048', 'mimes:jpg,jpeg,png' ],
        ]);

        if(!empty($validatedData['profile_picture'])) {
            $image = base64_encode(file_get_contents($validatedData['profile_picture']));

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
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'no_telephone' => $validatedData['no_telephone'],
            'location' => $validatedData['location'],
            'profile_picture' => $pp,
        ]);

        $userRole = Role::firstWhere('name', $request->user_role);
        $user->roles()->attach($userRole);
        
        Alert::success('Berhasil', ucfirst($request->user_role) . ' baru berhasil ditambahkan');
        return back();
    }

    public function updateUser(Request $request, Client $client)
    {
        
        $user = User::findOrFail($request->user_id);
        
        $validatedData = $request->validateWithBag('edit', [
            'name'            => [ 'nullable', 'string'],
            'email'           => [ 'nullable', 'email', Rule::unique('users')->ignore($user->id)],
            'password'        => [ 'nullable', 'min:6' ],
            'no_telephone'    => [ 'nullable', Rule::unique('users')->ignore($user->id) ],
            'location'        => [ 'nullable' ],
            'profile_picture' => [ 'nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png' ],
        ]);

        if(!empty($validatedData['profile_picture'])) {
            $image = base64_encode(file_get_contents($validatedData['profile_picture']));

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
            $pp = $user->profile_picture;
        }

        $input = collect($validatedData)->filter(function($value, $key) {
            return $value != null;
        });

        $input = $input->map(function($value, $key) use($pp) {
            if ( $key == 'password' ) {
                $value = Hash::make($value);
            }
            if( $key == 'profile_picture') {
                $value = $pp;
            }
            return $value;
        });

        $user->update($input->toArray());

        Alert::success('Berhasil', 'Data ' . $user->roles()->first()->name . ' berhasil di update');
        return back();
    }
}
