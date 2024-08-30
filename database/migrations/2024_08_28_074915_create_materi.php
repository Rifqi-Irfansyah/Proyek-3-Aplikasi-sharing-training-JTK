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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_pemateri');
            $table->string('judul_materi');
            $table->enum('status', ['Terkirim', 'Terverifikasi','Selesai']);
            $table->timestamps();

        });

        Schema::create('peserta_materi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_materi');
            $table->foreign('id_materi')
              ->references('id_materi')
              ->on('materi');
            $table->unsignedBigInteger('id_peserta');
            $table->foreign('id_peserta')
              ->references('username')
              ->on('users');
            $table->timestamps();

        });

        // Create Stored Procedures
        DB::statement('DROP PROCEDURE IF EXISTS `insert_peserta`');
        DB::statement('
        CREATE PROCEDURE `insert_peserta`(
          IN `id_materi` BIGINT,
          IN `id_peserta` BIGINT,
          IN `status_pembayaran` VARCHAR(10)
          )
          BEGIN
              INSERT INTO `peserta_materi` (`id_materi`, `id_peserta`, `status_pembayaran`)
              VALUES (id_materi, id_peserta, status_pembayaran);
          END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta_materi');
        Schema::dropIfExists('materi');
    }
};
