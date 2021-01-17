<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Participant extends Model
{
    protected $fillable = ['room_id', 'user_id'];

    public function room() {
        return $this->hasOne('App\Room', 'id', 'room_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
