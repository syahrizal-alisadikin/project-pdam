<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfrPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfr_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_pembayaran_id');
            $table->string('fk_rw_id');
            $table->string('jumlah');
            $table->string('image');
            $table->softDeletes();
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
        Schema::dropIfExists('konfr_pembayaran');
    }
}
