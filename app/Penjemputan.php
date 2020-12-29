<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    protected $fillable = [
                            'tanggal', 
                            'nasabah_id',
                            'pengurus1_id',
                            'status',
                            'lokasi',
                            'total_berat',
                            'total_harga',
                            'image',
                          ];
}
