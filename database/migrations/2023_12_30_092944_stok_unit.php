<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_stok_unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('harga');
            $table->string('tanggal');
            $table->integer('stok_masuk');
            $table->integer('stok_sisa');
            $table->integer('total_stok');
            $table->integer('total_harga_stok');
            $table->integer('total_harga_masuk');
            $table->integer('total_harga_keluar');
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
        //
    }
};
