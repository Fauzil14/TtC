<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjemputansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjemputans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjemputan_id')->constrained('penjemputans')->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained('sampahs')->onDelete('cascade');
            $table->decimal('berat', 8, 2);
            $table->decimal('harga_perkilogram', 10, 2);
            $table->decimal('harga', 10, 2);
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
        Schema::dropIfExists('detail_penjemputans');
    }
}
