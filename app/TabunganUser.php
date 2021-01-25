<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabunganUser extends Model
{
    protected $fillable = [
                            'nasabah_id',
                            'transaksi_id',
                            'hari/tanggal',
                            'keterangan',
                            'jenis_sampah',
                            'berat',
                            'debet',
                            'kredit',
                            'saldo',
                          ];

    public function nasabah() {
        return $this->hasOne('App\User', 'id', 'nasabah_id');
    }

    public function transaksi() {
        return $this->hasMany('App\Transaksi');
    }
}
