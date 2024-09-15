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

        Schema::create('tambahan_trainer', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->foreign('email')
              ->references('email')
              ->on('users');
            $table->string('no_wa');
            $table->string('cv');
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
