<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengepulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengepuls')->insert([
            [ 'pengepul' => 'pengepul 1', 'lokasi' => "https://www.google.com/maps/embed?pb=!4v1608799049411!6m8!1m7!1s4YHmTE6n7LigCzDTvIf4-g!2m2!1d-7.813942010467768!2d110.3481889266765!3f250.33088629804558!4f-7.500747373073992!5f0.7820865974627469"],
            [ 'pengepul' => 'pengepul 2', 'lokasi' => "https://www.google.com/maps/embed?pb=!4v1608799220687!6m8!1m7!1s11JMe0A53okchutTNt8jAw!2m2!1d-7.83415310346258!2d110.3766675261489!3f268.3456887989524!4f-2.4911822365075267!5f1.1471742312719198"],
            [ 'pengepul' => 'pengepul 3', 'lokasi' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31628.145695659536!2d110.32439129360606!3d-7.73472461782153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58a2bae5b547%3A0x58f0b155f39d55a5!2sArea%20Sawah%2C%20Tlogoadi%2C%20Kec.%20Mlati%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1608799368572!5m2!1sid!2sid"],
            [ 'pengepul' => 'pengepul 4', 'lokasi' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1976.5657278296082!2d110.36495380792545!3d-7.775882941051299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a583805b5ccaf%3A0x3edaeb99ba8cfb2c!2sYogyakarta%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1608799472003!5m2!1sid!2sid"],
            [ 'pengepul' => 'pengepul 5', 'lokasi' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31625.778944066067!2d110.35875234551733!3d-7.766227605656774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd0e0d93fb3d417e1!2sJual%20Beli%20ROSOK%20%26%20jasa%20angkut%20barang!5e0!3m2!1sid!2sid!4v1608799542316!5m2!1sid!2sid"]
        ]);
    }
}
