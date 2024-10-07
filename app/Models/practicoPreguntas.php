<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class practicoPreguntas extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function categoria(){
        return $this->belongsTo(practicoCategoria::class, 'id_categoria', 'id');
    }
}
