<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'id_usuario',
        'id_empresa',
        'usuario',
        'password',
        'estatus',
        'token'
    ];

    public function empresa(){
        return $this->hasMany(Empresa::class, 'id_empresa');
    }


}
