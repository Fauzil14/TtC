<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
                            'tanggal',
                            'pengurus2_id',
                            'pengepul_id',
                            'lokasi',
                            'total_berat_penjualan',
                            'total_debit_bank',
                          ];

    public function detail_penjualan() {
        return $this->hasMany('App\DetailPenjualan');
    }
}
