<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleGasto extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function gasto(){
        return $this->belongsTo(gasto::class, 'id_tipo' , 'id' );
    }
}
