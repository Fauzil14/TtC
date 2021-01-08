<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tanggal = Carbon::now()->toDateString();

        Schema::create('penjualans', function (Blueprint $table) use ($tanggal) {
            $table->id();
            $table->date('tanggal')->default($tanggal);
            $table->foreignId('pengurus2_id')->constrained('users');
            $table->foreignId('pengepul_id')->constrained('pengepuls');
            $table->text('lokasi')->nullable();
            $table->decimal('total_berat_penjualan', 10, 2)->nullable();
            $table->decimal('total_debit_bank', 10, 2)->nullable();
            $table->enum('status', ['dalam proses', 'selesai']);
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
        Schema::dropIfExists('penjualans');
    }
}
