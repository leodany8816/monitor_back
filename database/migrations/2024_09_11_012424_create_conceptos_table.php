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
    
        Schema::create('conceptos', function (Blueprint $table) {
            $table->increments('id_concepto');
            $table->unsignedInteger('id_factura');  // Asegúrate de que es un entero sin signo (unsigned)
            $table->foreign('id_factura')->references('id_factura')->on('facturas')->onDelete('cascade');  // Clave foránea correcta
            $table->decimal('importe', 15, 2)->nullable();
            $table->decimal('valor_unitario', 15, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->char('clave_unidad', 10)->nullable();
            $table->integer('clave_prod_serv')->nullable();
            $table->integer('cantidad')->nullable();
        });
    
        Schema::enableForeignKeyConstraints();
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conceptos');
    }
};
