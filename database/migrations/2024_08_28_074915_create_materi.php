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
            $table->id('id_materi');
            $table->unsignedBigInteger('id_peserta');
            // table relation id_user
            $table->foreign('id_pemateri')
              ->references('id_user')
              ->on('users');
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
        Schema::dropIfExists('materi');
    }
};
