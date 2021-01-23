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
        
        if( $this->from_id == Auth::id() && $this->status == 3 ) {
            return null;
        }

        $action = Route::currentRouteAction();

        return [
            'id'            => $this->id,
            'is_auth_user'  => $this->when($action == "App\Http\Controllers\Api\MessageController@getMessage", 
                                            $this->when($this->from_id == Auth::id(), TRUE, FALSE)),
            'from_user'     => new UserResource($this->whenLoaded('from')),
            'message'       => $this->message,
            'deleted_at,'   => $this->deleted_at,        
            'created_at,'   => $this->created_at,
            'updated_at,'   => $this->updated_at        
        ];
    }
}
