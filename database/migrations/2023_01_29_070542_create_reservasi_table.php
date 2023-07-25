<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_meja');
            $table->bigInteger('id_customer');
            $table->time('jam_booking');
            $table->date('tanggal');
            $table->bigInteger('id_rekening');
            $table->enum('status',['Aktif','Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE reservasi ADD code VARCHAR(5) NOT NULL DEFAULT concat(substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ',floor(rand()*26)+1,1), LPAD(floor(rand()*1000)+1, 4, 0)) FIRST");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
};
