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
        Schema::dropIfExists('materi');
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_pemateri');
            $table->string('judul_materi');
            $table->enum('status', ['Terkirim', 'Terverifikasi','Selesai']);
            $table->timestamps();

        });

        Schema::dropIfExists('peserta_materi');
        Schema::create('peserta_materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_peserta');
            $table->timestamps();

        });

        // Create Stored Procedures
        DB::statement('DROP PROCEDURE IF EXISTS `insert_peserta`');
        DB::statement('
        CREATE PROCEDURE `insert_peserta`(
          IN `id_materi` BIGINT,
          IN `id_peserta` BIGINT)
          BEGIN
              INSERT INTO `peserta_materi` (`id_materi`, `id_peserta`)
              VALUES (id_materi, id_peserta);
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
        Schema::dropIfExists('materi');
    }
};
