<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name'];

    public function participant() {
        return $this->hasMany('App\Participant', 'room_id', 'id');
    }

    public function messages() {
        return $this->hasMany('App\Message', 'room_id', 'id');
    }
}
