<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rw', function (Blueprint $table) {
            $table->uuid('rw_id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('alamat');
            $table->integer('fk_kelurahan_id');
            $table->integer('fk_kecamatan_id');
            $table->integer('fk_kota_id');
            $table->integer('fk_provinsi_id');
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
        Schema::dropIfExists('tbl_rw');
    }
}
