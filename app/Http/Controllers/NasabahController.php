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

class NasabahController extends Controller
{
    
    public function index(User $user)
    {
        $nasabahs = $user->whoHasRole('nasabah')->get();
        
        return view('nasabah.index')->with(compact('nasabahs'));
    }

    public function delete($user_id)
    {
        User::findOrFail($user_id)->delete();

        return back();
    }

    public function show($user_id)
    {
        User::findOrFail($user_id);
    }

    public function tambahNasabah(Request $request, Client $client) 
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

        $nasabahRole = Role::firstWhere('name', 'nasabah');
        $user->roles()->attach($nasabahRole);
        
        Alert::success('Berhasil', 'Nasabah baru berhasil ditambahkan');
        return back();
    }

    public function updateNasabah(Request $request, Client $client)
    {
        $user = User::findOrFail($request->user_id);
        
        $validatedData = $request->validateWithBag('edit', [
            'name'            => [ 'required' ,'string'],
            'email'           => [ 'required' ,'email', Rule::unique('users')->ignore($user->id)],
            'password'        => [ 'min:6' ],
            'no_telephone'    => [ Rule::unique('users')->ignore($user->id) ],
            'location'        => [ 'nullable' ],
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
        } else {
            $pp = $user->profile_picture;
        }

        return back();
    }
}
