<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleExamen extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'detalle_examenes';

    public function examen(){
        return $this->belongsTo(examen::class, 'id_examen', 'id');
    }

    public function pregunta(){
        return $this->belongsTo(pregunta::class,'id_pregunta','id');
    }

    public function respuesta(){
        return $this->belongsTo(respuesta::class,'id_respuesta','id');
    }

    public function respuestaCorrecta(){
        return $this->belongsTo(respuesta::class,'id_respuesta_correcta','id');
    }
}
