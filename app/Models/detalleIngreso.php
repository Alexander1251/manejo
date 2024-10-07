<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleIngreso extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function ingreso(){
        return $this->belongsTo(ingreso::class, 'id_ingreso', 'id');

    }

    public function procedencia(){
        return $this->belongsTo(escuela::class, 'id_procedencia', 'id');
    }
}
