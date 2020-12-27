<?php

use App\GolonganSampah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('golongan_sampahs')->insert([
            [ 'golongan' => 'KELOMPOK PLASTIK' ],
            [ 'golongan' => 'LOGAM' ],
            [ 'golongan' => 'KERTAS' ],
            [ 'golongan' => 'KACA' ],
        ]);
    }
}
