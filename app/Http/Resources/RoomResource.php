<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PartcipantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $raw_latest_message = $this->messages->sortByDesc('created_at')->first();
        
        $now = Carbon::now();
        $yesterday = Carbon::now()->subDay()->toDateTimeString();
        $last_week = Carbon::now()->subWeek()->toDateTimeString();
        $last_year = Carbon::now()->subYear()->toDateTimeString();

        if(!empty($raw_latest_message)) {
            $raw_latest_message = $raw_latest_message->created_at;
            switch (TRUE) {
                case $raw_latest_message->isSameDay($now) :
                    $latest_message = $raw_latest_message->format('h:i');
                    break;
                case $raw_latest_message->isSameDay($yesterday) :
                    $latest_message = 'Kemarin';
                    break;
                case $raw_latest_message->betweenExcluded($last_week, $yesterday) :
                    $latest_message = $raw_latest_message->translatedFormat('l');
                    break;
                case $raw_latest_message->betweenExcluded($last_year, $yesterday) :
                    $latest_message = $raw_latest_message->translatedFormat('d M y');
                    break;
                default :
                    $latest_message = $raw_latest_message->translatedFormat('d-m-Y');
            }
        } else {
            $latest_message = $raw_latest_message;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact' => new UserResource($this->participant->first()->user),
            'unread' => count($this->messages->where('from_id', '!=', Auth::id())->where('status', 1)),
            'latest_message' => $latest_message 
        ];

        // Note : The whenLoaded('the name of the relationship') method may be used to conditionally load a relationship
    }
}
