<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expediente extends Model
{
    use HasFactory;
    public $timestamps = false;
   

    public function cliente(){
        return $this->belongsTo(usuario::class,'id_cliente','id');
    }

    public function ingreso(){
        return $this->belongsTo(ingreso::class,'id_ingreso','id');
    }

    public function licenciaTipo(){
        return $this->belongsTo(licenciaTipo::class,'id_licencia_tipo','id');
    }

    public function pruebaPractica(){
        return $this->hasOne(pruebaPractica::class, 'id_expediente', 'id');
    }

    public function escuela(){
        return $this->belongsTo(escuela::class, 'id_escuela', 'id');
    }

    public function examen_teorico(){
        return $this->hasOne(examen::class, 'id_expediente', 'id');

    }

    public function examen_practico(){
        return $this->hasOne(pruebaPractica::class, 'id_expediente', 'id');

    }

    
}
