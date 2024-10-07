<?php

namespace App\Http\Controllers;

use App\Models\detalleExamen;
use App\Models\examen;
use App\Models\examenConfiguracion;
use App\Models\expediente;
use Illuminate\Http\Request;
use App\Models\pregunta;
use App\Models\respuesta;
use App\Models\usuario;


class ApiController extends Controller
{
    public function preguntas(Request $request){
        $preguntas = pregunta::all();
        return response()->json($preguntas);
    }

    
    public function respuestas(Request $request){
        $respuestas = respuesta::all();
        return response()->json($respuestas);
    }
    

    public function detalle(Request $request){

        $detalle = new detalleExamen();
        
        


        $detalle->id_examen = $request['examen'];
        $detalle->id_pregunta = $request['pregunta'];
        $respuestaC = respuesta::where('id_pregunta', $request['pregunta'])->where('validez', 'Correcta')->first();
        $detalle->id_respuesta = $request['respuesta'];
        $detalle->id_respuesta_correcta = $respuestaC->id;

        $detalle->save();

        $examen = examen::find($detalle->id_examen);
        if($detalle->id_respuesta == $detalle->id_respuesta_correcta){
            $examen->total_respuestas_correctas++;
           
        }
        $examen->calificacion = (10/4)*($examen->total_respuestas_correctas);
        $examen->save();
        
        


        return ["Resultado" => $request['examen']];
    }

    
    public function cambiarEstado(Request $request){
        
        $configuracion = examenConfiguracion::get()->first();
       
        $examen = examen::find($request['examen']);
       
        $examen->estado = 'Finalizado';
     
        if($examen->calificacion >= $configuracion->nota_aprobada){
            $expediente = expediente::where('id_cliente', $examen->expediente->cliente->id)->first();
            $expediente->estado_examen_teorico = 'Aprobado';
            $expediente->save();

        }
        else{
            $expediente = expediente::where('id_cliente',  $examen->expediente->cliente->id)->first();
            $expediente->estado_examen_teorico = 'Reprobado';
            $expediente->save();
        }

        
        $examen->tiempo = $request['tiempo'];
        $examen->save();

        return ["Resultado" => "Datos recibidos"];

    }
}
