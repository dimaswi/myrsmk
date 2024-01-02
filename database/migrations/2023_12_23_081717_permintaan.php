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
        Schema::create('tb_permintaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_permintaan');
            $table->string('nomor');
            $table->string('unit');
            $table->string('tanggal');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('tanda_terima');
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
