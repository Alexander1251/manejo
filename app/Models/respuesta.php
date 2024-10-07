<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class respuesta extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function pregunta(){
        return $this->belongsTo(pregunta::class,'id_pregunta','id');
    }
}
