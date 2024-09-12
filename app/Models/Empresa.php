<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $primaryKey = 'id_empresa';
    protected $fillable = [
        'id_empresa',
        'nombre',
        'rfc',
        'logo'
    ];

    public function facturas(){
        return $this->belongsTo(Factura::class);
    }

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id_empresa');
    }
}
