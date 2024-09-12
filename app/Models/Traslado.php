<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'traslados';
    protected $primaryKey = 'id_traslado';
    protected $fillable = [
        'id_traslado',
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
