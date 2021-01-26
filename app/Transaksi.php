<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
                            'tanggal',
                            'nasabah_id',
                            'keterangan_transaksi',
                            'penyetoran_id',
                            'debet',
                            'kredit',
                          ];
    
    public function nasabah() {
        return $this->hasOne('App\User', 'id', 'nasabah_id');
    }
    
    public function penyetoran() {
        return $this->hasOne('App\Penyetoran');
    }
}
