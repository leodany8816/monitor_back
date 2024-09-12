<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    protected $fillable = [
        'id_factura',
        'id_empresa',
        'comprobante_version',
        'comprobante_serie',
        'comprobante_folio',
        'comprobante_fecha',
        'comprobante_sello',
        'comprobante_formaPago',
        'comprobante_noCertificado',
        'comprobante_Certificado',
        'comprobante_SubTotal',
        'comprobante_Moneda',
        'comprobante_Total',
        'comprobante_TipoDeComprobante',
        'comprobante_MetodoPago',
        'comprobante_LugarExpedicion',
        'comprobante_Uuid',
        'comprobante_NoCertificadoSat',
        'comprobante_SelloCFD',
        'comprobante_VersionTimbrado',
        'comprobante_FechaTimbrado',
        'comprobante_SelloSat',
        'emisor_RegimenFiscal',
        'emisor_Rfc',
        'emisor_Nombre',
        'receptor_Rfc',
        'receptor_DomicilioFiscalReceptor',
        'receptor_RegimenFiscalReceptor',
        'receptor_UsoCFDI',
        'receptor_Rfc',
        'impuesto_trasladado',
        'impuesto_retenido',
        'nombre_xml',
        'nombre_pdf',
        'fecha_carga',
        'fecha_creacion',
        'id_concepto'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function conceptos(){
        return $this->hasMany(Concepto::class, 'id_factura');
    }

    public function retenciones(){
        return $this->hasMany(Retencion::class, 'id_factura');
    }

    public function traslados(){
        return $this->hasMany(Traslado::class, 'id_factura');
    }


}
