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
        Schema::create('absen', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jadwal');
            $table->foreign('id_jadwal')
                ->references('id_jadwal')
                ->on('jadwal_training');
            $table->string('email');
            $table->foreign('email')
                ->references('email')
                ->on('users');
            $table->enum('status', ['Hadir', 'Tidak Hadir']);
            $table->timestamps();

            $table->unique(['id_jadwal', 'email']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
};
