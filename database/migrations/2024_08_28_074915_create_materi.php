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
            $table->string('email_pemateri');
            $table->foreign('email_pemateri')
            ->references('email')
            ->on('users');
            $table->string('judul_materi');
            $table->enum('status', ['Terkirim', 'Terverifikasi','Selesai']);
            $table->timestamps();

        });

        Schema::create('peserta_materi', function (Blueprint $table) {
            $table->id('id_peserta_materi');
            $table->unsignedBigInteger('id_materi');
            $table->foreign('id_materi')
              ->references('id_materi')
              ->on('materi');
            $table->string('email_peserta');
            $table->foreign('email_peserta')
              ->references('email')
              ->on('users');
            $table->timestamps();
        });

        Schema::create('jadwal_materi', function (Blueprint $table) {
          $table->id('id_jadwal');
          $table->unsignedBigInteger('id_materi');
          $table->foreign('id_materi')
            ->references('id_materi')
            ->on('materi');
          $table->DATETIME('waktu_mulai');
          $table->DATETIME('waktu_selesai');
          $table->timestamps();
      });

        // Create Stored Procedures
        DB::statement('DROP PROCEDURE IF EXISTS `insert_peserta`');
        DB::statement('
        CREATE PROCEDURE `insert_peserta`(
          IN `id_peserta_materi` BIGINT UNSIGNED,
          IN `id_materi` BIGINT UNSIGNED,
          IN `email_peserta` VARCHAR(255)
        )
          BEGIN
              INSERT INTO `peserta_materi` (`id_peserta_materi`, `id_materi`, `email_peserta`)
              VALUES (id_peserta_materi, id_materi, email_peserta);
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
        Schema::dropIfExists('jadwal_materi');
        Schema::dropIfExists('materi');
    }
};