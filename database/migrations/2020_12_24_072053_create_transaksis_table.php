<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('hari/tanggal');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('keterangan_transaksi', ['setor', 'tarik']);
            $table->foreignId('penyetoran_id')->constrained('penyetorans');
            $table->foreignId('detail_penyetoran_id')->constrained('detail_penyetorans');
            $table->decimal('debet', 10, 2);
            $table->decimal('kredit', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
