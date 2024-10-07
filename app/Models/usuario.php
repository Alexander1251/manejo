<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class usuario extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'dui',
        'sexo',
        'telefono',
        'usuario',
        'id_rol',
        'email',
        'estado',
        'password',
        'direccion',
        'municipio',
        'departamento',
        'nrc',
        'giro',
        'nit',
    ];

    
    public function rol()
    {
        return $this->belongsTo(rol::class, 'id_rol', 'id');
    }

    public function expediente()
    {
        return $this->hasMany(expediente::class, 'id_cliente', 'id');
    }
}
