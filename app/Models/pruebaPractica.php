<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pruebaPractica extends Model
{
    use HasFactory;
    public $table = 'prueba_practica';
    public $timestamps = false;

    public function expediente(){
        return $this->belongsTo(expediente::class,'id_expediente','id');
    }

    public function examinador(){
        return $this->belongsTo(usuario::class,'id_examinador','id');
    }

    public function detalles(){
        return $this->hasMany(practicoDetalle::class, 'id_examen', 'id');
    }
}
