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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->integer('harga');
            $table->bigInteger('id_kategori');
            $table->enum('status',['Tersedia','Habis'])->default('Tersedia');
            $table->enum('kategori_halal',['Halal','Non-Halal'])->default('Halal');
            $table->string('foto');
            $table->string('desc')->nullable()->default(null);
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
        Schema::dropIfExists('menu');
    }
};
