<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('alamat_bank');
            $table->decimal('total_sampah_masuk', 10, 2)->default(0);
            $table->decimal('total_sampah_keluar', 10, 2)->default(0);
            $table->decimal('total_debit_nasabah', 10, 2)->default(0);
            $table->decimal('total_kredit_nasabah', 10, 2)->default(0);
            $table->decimal('total_penjualan_ke_pengepul', 10, 2)->default(0);
            $table->decimal('total_saldo', 10, 2)->default(0);
            $table->timestamps();
        });

        DB::table('banks')->insert([
                                    'alamat_bank' => 'https://goo.gl/maps/AJDPv2BDLnjh8wzz6',
                                    'total_saldo' => 10000000 
                                    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
