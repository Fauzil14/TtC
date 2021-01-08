<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyetoransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateString();

        Schema::create('penyetorans', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->date('tanggal')->default($tanggal);
            $table->foreignId('nasabah_id')->constrained('users');
            $table->foreignId('pengurus1_id')->constrained('users');
            $table->enum('keterangan_penyetoran', ['diantar', 'dijemput']);
            $table->unsignedBigInteger('penjemputan_id')->nullable();
            $table->text('lokasi')->nullable();
            $table->decimal('total_berat', 8, 2)->nullable();
            $table->decimal('total_debit', 10, 2)->nullable();
            $table->enum('status', ['dalam proses', 'selesai']);
            $table->timestamps();

            $table->foreign('penjemputan_id')->references('id')->on('penjemputans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyetorans');
    }
}
