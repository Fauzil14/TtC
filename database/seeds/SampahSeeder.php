<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sampahs')->insert([
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PP GELAS BENING BERSIH',
             'contoh' => null,
             'harga_perkilogram' => 5500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PP GELAS BENING KOTOR',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PP GELAS WARNA BERSIH',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PP GELAS WARNA KOTOR',
             'contoh' => null,
             'harga_perkilogram' => 3000,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PET BENING',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PET KOTOR',
             'contoh' => null,
             'harga_perkilogram' => 2500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PET WARNA BERSIH',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PET WARNA KOTOR',
             'contoh' => null,
             'harga_perkilogram' => 2500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PLASTIK HD CAMPUR',
             'contoh' => null,
             'harga_perkilogram' => 3000,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'NILES',
             'contoh' => null,
             'harga_perkilogram' => 1200,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'LDPE INFUS',
             'contoh' => null,
             'harga_perkilogram' => 4500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'TUTUP GALON',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PLASTIK DAUN',
             'contoh' => null,
             'harga_perkilogram' => 2500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'DAMAR',
             'contoh' => null,
             'harga_perkilogram' => 500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'DAMAR BENING',
             'contoh' => null,
             'harga_perkilogram' => 2500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'PLASTIK BLOW',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'KARUNG',
             'contoh' => null,
             'harga_perkilogram' => 300,
            ],
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'KASET / CD',
             'contoh' => null,
             'harga_perkilogram' => 4500,
            ],            
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'REFILL',
             'contoh' => null,
             'harga_perkilogram' => 3500,
            ],            
            [ 
             'golongan' => 'Kelompok Plastik' ,
             'jenis_sampah' => 'KANTONG KRESEK',
             'contoh' => null,
             'harga_perkilogram' => 1500,
            ],            

        ]);
    }
}
