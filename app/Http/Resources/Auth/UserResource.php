<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verfied_at,
            'no_telehone' => $this->no_telephone,
            'location' => $this->location,
            'profile_picture' => $this->profile_picture,
            'role' => $this->roles[0]->role_name
        ];
    }
}
