<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratkeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('id_surat')->unique(); 
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_keluar');
            $table->string('pengirim');
            $table->string('perihal')->nullable();
            $table->string('kategori')->nullable();
            $table->string('sifat')->nullable();
            $table->string('file_surat')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('surat_keluar');
    }
}
