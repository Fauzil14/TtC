<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateTimeString();
        
        Schema::create('transaksi_banks', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->date('hari/tanngal')->default($tanggal);
            $table->foreignId('pegawai_id')->constrained('users');
            $table->enum('keterangan_pengurus', ['pengurus-satu', 'pengurus-dua', 'bendahara']);
            $table->enum('keterangan_transaksi', ['debet_nasabah', 'kredit_nasabah', 'penjualan_bank']);
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('transaksis');
            $table->foreign('penjualan_id')->references('id')->on('penjualans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_banks');
    }
}
