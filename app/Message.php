<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['room_id', 'from_id' , 'message', 'status', 'deleted_at'];

    public function room() {
        return $this->hasOne('App\Room');
    }

    public function from() {
        return $this->hasOne('App\User', 'id', 'from_id');
    }

    public function deletedMessage() {
        return $this->hasOne('App\DeletedMessage');
    }
}
