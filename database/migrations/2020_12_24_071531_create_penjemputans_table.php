<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjemputansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjemputans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('nasabah_id')->constrained('users');
            $table->foreignId('pengurus1_id')->contrained('users');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'berhasil'])->nullable();
            $table->text('lokasi')->nullable();
            $table->decimal('total_berat', 8, 2)->nullable();
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('penjemputans');
    }
}
