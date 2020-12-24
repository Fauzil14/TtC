<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyetoransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyetorans', function (Blueprint $table) {
            $table->id();
            $table->date('hari/tanggal');
            $table->foreignId('user_id')->constrained('users');
            $table->text('lokasi');
            $table->enum('keterangan_penyetoran', ['diantar', 'dijemput']);
            $table->decimal('total_debit', 10, 2);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('penyetorans');
    }
}
