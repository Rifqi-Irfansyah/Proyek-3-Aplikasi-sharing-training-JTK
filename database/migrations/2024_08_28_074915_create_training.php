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
      Schema::create('training', function (Blueprint $table) {
          $table->id('id_training');
          $table->string('email_trainer')->nullable();;
          $table->foreign('email_trainer')
          ->references('email')
          ->on('users');
          $table->string('judul_training');
          $table->string('deskripsi');
          $table->enum('status', ['Pendaftaran', 'Berlangsung','Selesai']);
          $table->string('kuota');
          $table->timestamps();

      });

      Schema::create('peserta_training', function (Blueprint $table) {
          $table->id('id_peserta_training');
          $table->unsignedBigInteger('id_training');
          $table->foreign('id_training')
            ->references('id_training')
            ->on('training');
          $table->string('email_peserta');
          $table->foreign('email_peserta')
            ->references('email')
            ->on('users');
          $table->timestamps();
      });

      Schema::create('jadwal_training', function (Blueprint $table) {
        $table->id('id_jadwal');
        $table->unsignedBigInteger('id_training');
        $table->foreign('id_training')
          ->references('id_training')
          ->on('training');
        $table->string('tempat_pelaksana');
        $table->string('modul')->nullable();
        $table->enum('status', ['online', 'offline']);
        $table->DATETIME('waktu_mulai');
        $table->DATETIME('waktu_selesai');
        $table->timestamps();
      });

      Schema::create('pengajuan_trainer', function (Blueprint $table) {
        $table->unsignedBigInteger('id_training')->unique();
        $table->foreign('id_training')
          ->references('id_training')
          ->on('training');
        $table->string('email_trainer')->unique();
        $table->foreign('email_trainer')
          ->references('email')
          ->on('users');
        $table->enum('status_pengajuan', ['Dikirim', 'Diterima','Ditolak']);
        $table->timestamps();
      });

      // Create Stored Procedures
      DB::statement('DROP PROCEDURE IF EXISTS `insert_peserta`');
      DB::statement('
        CREATE PROCEDURE `insert_peserta`(
          IN `id_peserta_training` BIGINT UNSIGNED,
          IN `id_training` BIGINT UNSIGNED,
          IN `email_peserta` VARCHAR(255)
        )
        BEGIN
            INSERT INTO `peserta_training` (`id_peserta_training`, `id_training`, `email_peserta`)
            VALUES (id_peserta_training, id_training, email_peserta);
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
        Schema::dropIfExists('peserta_training');
        Schema::dropIfExists('jadwal_training');
        Schema::dropIfExists('training');
    }
};