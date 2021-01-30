<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabunganUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateTimeString();

        Schema::create('tabungan_users', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            $table->date('hari/tanggal')->default($tanggal);
            $table->enum('keterangan', ['diantar', 'dijemput', 'penarikan']);
            $table->string('jenis_sampah')->nullable();
            $table->decimal('berat', 8, 2)->nullable();
            $table->decimal('debet', 10, 2)->nullable();
            $table->decimal('kredit', 10, 2)->nullable();
            $table->decimal('saldo', 10, 2)->nullable();
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
        Schema::dropIfExists('tabungan_users');
    }
}
