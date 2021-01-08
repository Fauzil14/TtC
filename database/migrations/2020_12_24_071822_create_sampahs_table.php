<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('golongan_sampah_id')->constrained('golongan_sampahs');
            $table->string('jenis_sampah');
            $table->string('contoh')->nullable();
            $table->decimal('harga_perkilogram', 8, 2);
            $table->decimal('harga_jual_perkilogram', 8, 2);
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
        Schema::dropIfExists('sampahs');
    }
}
