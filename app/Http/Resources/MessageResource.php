<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // message status 
        //   1 => 'unread', 
        //   2 => 'read',
        //   3 => 'deleted_for_auth_user_only'
        //   4 => 'deleted_for_all', 
        
            switch ($this->status) {
                case $this->status == 1 : 
                    $is_message = 'unread';
                    break;
                case $this->status == 2 : 
                    $is_message = 'read';
                    break;
                case $this->status == 3 : 
                    $is_message = 'deleted_for_auth_user_olny';
                    break;
                case $this->status == 4 :
                    $is_message = 'deleted_for_all';
                    break;
            }

        return [
            'id'            => $this->id,
            'status'        => $this->status,
            'from'          => $this->from->only('id', 'name', 'profile_picture'),
            'message'       => $this->message,
            // $this->mergeWhen($currentRoute == "App\Http\Controllers\Api\MessageController@getMessage", [
                'is_auth_user'    => $this->when($this->from_id == Auth::id(), TRUE, FALSE),
                'is_message'      => $is_message,
                'created_at_date' => $this->when($this->created_at->isToday(), 'Hari Ini', 
                                                    $this->created_at->isYesterday() ? 'Kemarin' 
                                                                                     : $this->created_at->translatedFormat('j F Y')),
                'created_at_time' => $this->created_at->translatedFormat('H:i'),
            // ]),
        ];
    }
}
