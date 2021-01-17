<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['room_id', 'from_id' , 'message', 'status'];

    public function room() {
        return $this->hasOne('App\Room');
    }

    public function from() {
        return $this->hasOne('App\User', 'id', 'from_id');
    }
}
