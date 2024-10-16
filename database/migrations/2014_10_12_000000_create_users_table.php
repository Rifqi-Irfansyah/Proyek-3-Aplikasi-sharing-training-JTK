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
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->enum('role',['admin','pemateri','peserta']);
            $table->char('name', 50);
            $table->enum('gender',['laki-laki','perempuan']);
            $table->date('tanggal_lahir');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tambahan_trainer', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->foreign('email')
              ->references('email')
              ->on('users');
            $table->char('no_wa',20);
            $table->string('kemampuan');
            $table->enum('pengalaman',['belum ada','<1 tahun','1-3 tahun','3 tahun +']);
            $table->enum('status_akun',['Terkonfirmasi','Belum direview','Ditolak']);
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
        Schema::dropIfExists('tambahan_pemateri');
        Schema::dropIfExists('users');
    }
};
