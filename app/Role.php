<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['pivot'];
    
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
