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
            $table->string('name');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tambahan_pemateri', function (Blueprint $table) {
            $table->string('email');
            $table->foreign('email')
              ->references('email')
              ->on('users');
            $table->string('no_wa');
            $table->string('pengalaman');
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
