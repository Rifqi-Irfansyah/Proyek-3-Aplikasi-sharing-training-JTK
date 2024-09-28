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
        Schema::create('usulan', function (Blueprint $table) {
            $table->id('id_usulan');
            $table->char('judul_materi',50);
            $table->string('bahasan');
            $table->string('email_pengusul');
            $table->foreign('email_pengusul')
            ->references('email')
            ->on('users');
            $table->string('usulan');
            $table->enum('status', ['Dilihat', 'Belum dilihat']);
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
        Schema::dropIfExists('usulan');
    }
};
