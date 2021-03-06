<?php

namespace App\Http\Resources;

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
            'no_telephone' => $this->no_telephone,
            'profile_picture' => $this->profile_picture,
            'penjemputan' => $this->whenLoaded('penjemputan'),
            'message' => $this->whenLoaded('messages'),
            'role' => $this->roles->first()->name
        ];
    }
}
