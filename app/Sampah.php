<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    public function detail_penyetoran() {
        return $this->hasMany('App\DetailPenyetoran');
    }
}
