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

        Schema::create('traslados', function (Blueprint $table) {
            $table->increments('id_traslado');
            $table->unsignedInteger('id_factura');  // Asegúrate de que es un entero sin signo (unsigned)
            $table->foreign('id_factura')->references('id_factura')->on('facturas')->onDelete('cascade'); 
            $table->float('importe')->nullable();
            $table->char('tipo_factor', 25)->nullable();
            $table->float('tasa_cuota')->nullable();
            $table->integer('impuesto')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslados');
    }
};
