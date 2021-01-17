<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'participant' => PartcipantResource::collection($this->whenLoaded('participant'))
        ];

        // Note : The whenLoaded('the name of the relationship') method may be used to conditionally load a relationship
    }
}
