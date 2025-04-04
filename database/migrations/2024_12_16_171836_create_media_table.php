<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kategori_media_id'); 
            $table->string('kode_media');
            $table->string('nama_file');
            $table->string('tipe_file');
            $table->bigInteger('ukuran_file'); 
            $table->string('kategori');
            $table->unsignedInteger('diupload_oleh');
            $table->string('path');
            $table->timestamps();
        
            // Foreign Key
            $table->foreign('kategori_media_id')->references('id_kategori_media')->on('kategori_media');
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
        Schema::dropIfExists('media');
    }
}
