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
        Schema::create('modul_training', function (Blueprint $table) {
            $table->id('id_training');
            $table->foreign('id_training')
                ->references('id_training')
                ->on('training');

            $table->char('nama_file',50);
            $table->foreign('nama_file')
                ->references('nama_file')
                ->on('modul');
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
        Schema::dropIfExists('modul_training');
    }
};
