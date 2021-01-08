<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjemputansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateString();

        Schema::create('penjemputans', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->date('tanggal')->default($tanggal);
            $table->foreignId('nasabah_id')->constrained('users');
            $table->foreignId('pengurus1_id')->contrained('users');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'berhasil', 'gagal'])->nullable();
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
