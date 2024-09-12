<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->foreign('id_usuario')->references('id_empresa')->on('empresas');
            $table->integer('id_empresa');
            $table->string('usuario', 30);
            $table->string('password', 255);
            $table->smallInteger('estatus');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
