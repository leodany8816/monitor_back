<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function empresa(){
        return $this->hasMany(Empresa::class, 'id_empresa');
    }
    


}
