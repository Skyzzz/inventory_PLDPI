<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat')->unique(); 
            $table->unsignedInteger('kategori_surat_id'); 
            $table->string('nomor_surat');
            $table->string('nama_surat');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->string('pengirim');
            $table->string('perihal')->nullable();
            $table->string('kategori')->nullable();
            $table->string('file_surat')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedInteger('diupload_oleh');
            $table->timestamps();

            $table->foreign('kategori_surat_id')->references('id_kategori_surat')->on('kategori_surat');
            $table->foreign('diupload_oleh')->references('id_user')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
}
