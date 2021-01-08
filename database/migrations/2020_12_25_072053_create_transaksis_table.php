<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateString();

        Schema::create('transaksis', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->date('tanggal')->default($tanggal);
            $table->foreignId('nasabah_id')->constrained('users');
            $table->enum('keterangan_transaksi', ['diantar', 'dijemput', 'penarikan']);
            $table->unsignedBigInteger('penyetoran_id')->nullable();
            $table->decimal('debet', 10, 2)->nullable();
            $table->decimal('kredit', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('penyetoran_id')->references('id')->on('penyetorans');
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
