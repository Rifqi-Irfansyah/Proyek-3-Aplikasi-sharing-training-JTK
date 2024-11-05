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
        Schema::create('pengajuan_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_training');
            $table->string('email_trainer');
            $table->enum('status_pengajuan', ['Diterima', 'Ditolak', 'Dikirim'])->default('Dikirim');

            $table->foreign('id_training')->references('id_training')->on('training')->onDelete('cascade');
            $table->foreign('email_trainer')->references('email')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('pengajuan_trainer');
    }
};
