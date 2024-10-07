<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class practicoDetalle extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function pregunta(){
        return $this->belongsTo(practicoPreguntas::class, 'id_pregunta', 'id');
    }

    

    
}
