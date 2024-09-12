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
    
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id_factura');
            $table->unsignedInteger('id_empresa');  
            $table->foreign('id_empresa')->references('id_empresa')->on('empresas');
            $table->string('comprobante_version', 5)->nullable();
            $table->string('comprobante_serie', 25)->nullable();
            $table->string('comprobante_folio', 25)->nullable();
            $table->string('comprobante_fecha', 255)->nullable();
            $table->text('comprobante_sello')->nullable();
            $table->string('comprobante_formaPago', 255)->nullable();
            $table->string('comprobante_NoCertificado', 255)->nullable();
            $table->text('comprobante_Certificado')->nullable();
            $table->decimal('comprobante_SubTotal', 15, 2)->nullable();
            $table->string('comprobante_Moneda', 50)->nullable()->default('MXN');  // Cambié el valor por defecto
            $table->decimal('comprobante_Total', 15, 2)->nullable();
            $table->string('comprobante_TipoDeComprobante', 30)->nullable();
            $table->string('comprobante_MetodoPago', 255)->nullable();
            $table->string('comprobante_LugarExpedicion', 255)->nullable();
            $table->text('comprobante_Uuid')->nullable();  // Corregido el nombre
            $table->text('comprobante_NoCertificadoSat')->nullable();  // Corregido el nombre
            $table->text('comprobante_SelloCFD')->nullable();  // Corregido el nombre
            $table->string('comprobante_VersionTimbrado', 5)->nullable();  // Corregido el nombre
            $table->string('comprobante_FechaTimbrado', 255)->nullable();  // Corregido el nombre
            $table->text('comprobante_SelloSat')->nullable();  // Corregido el nombre
            $table->string('emisor_RegimenFiscal', 255)->nullable();
            $table->string('emisor_Rfc', 255)->nullable();
            $table->string('emisor_Nombre', 255)->nullable();
            $table->string('receptor_Rfc', 255)->nullable();
            $table->string('receptor_Nombre', 255)->nullable();
            $table->string('receptor_DomicilioFiscalReceptor', 255)->nullable();
            $table->string('receptor_RegimenFiscalReceptor', 255)->nullable();
            $table->string('receptor_UsoCFDI', 255)->nullable();
            $table->decimal('impuesto_trasladado', 15, 2);
            $table->decimal('impuesto_retenido', 15, 2);
            $table->string('nombre_xml', 255)->nullable();
            $table->string('nombre_pdf', 255)->nullable();
            $table->date('fecha_carga')->nullable();
            $table->date('fecha_creacion')->nullable();
        });
    
        Schema::enableForeignKeyConstraints();
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
