<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedMessage extends Model
{
    protected $fillable = [ 'message_id', 'deleted_by_id', 'deleted_message' ];

    public function messages() {
        return $this->hasOne('App\Message');
    }

}
