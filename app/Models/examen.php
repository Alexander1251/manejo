<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class examen extends Model
{
    use HasFactory;
    
    public $table = 'examenes';

    public function expediente(){
        return $this->belongsTo(expediente::class, 'id_expediente', 'id');
    }

    public function detalles(){
        return $this->hasMany(detalleExamen::class, 'id_examen', 'id');
    }

    

  

   
}
