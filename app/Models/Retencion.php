<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retencion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'retenciones';
    protected $primaryKey = 'id_retencion';
    protected $fillable = [
        'id_retencion',
        'id_factura',
        'importe',
        'tipo_factor',
        'tasa_cuota',
        'impuesto'
    ];

    public function factura(){
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}
