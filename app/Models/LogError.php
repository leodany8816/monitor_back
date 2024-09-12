<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_log_error';
    protected $table = 'log_errores';
    protected $fillable = [
        'id_log_error',
        'tipo_error',
        'motivo'
    ];
}
