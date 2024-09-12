<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'conceptos';
    protected $primaryKey = 'id_concepto';
    protected $fillable = [
        'id_concepto',
        'id_factura',
        'importe',
        'valor_unitario',
        'descripcion',
        'clave_unidad',
        'clave_prod_serv',
        'cantidad'
    ];

    public function factura(){
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}
