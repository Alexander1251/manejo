<?php

namespace App\Http\Controllers;

use App\Models\pregunta;
use App\Models\respuesta;
use Illuminate\Http\Request;

class respuestasController extends Controller
{
    public function index($id_pregunta){
        $respuestas = respuesta::where("id_pregunta",$id_pregunta)->get();
        $pregunta = pregunta::find($id_pregunta);
        return view('respuestas.index', ['respuestas' => $respuestas, 'pregunta' => $pregunta]);
    }
    
    public function store(Request $request, $id_pregunta){
        $request->validate([
            'respuesta' => 'required',
            'validez' => 'required',
            'estado' => 'required',
        ]);
    
        $respuesta = new respuesta();
        $respuesta->respuesta = $request->respuesta;
        $respuesta->id_pregunta = $id_pregunta;
        $unica_correcta = respuesta::where('id_pregunta', $id_pregunta)->where('validez', 'Correcta')->first();
        if(isset($unica_correcta)){
            if($unica_correcta->validez == $request->validez){
                return redirect(route('respuestas.index', ['id_pregunta' => $id_pregunta]))->withErrors('Solo puede haber una respuesta correcta');
            }
            else{
                $respuesta->validez = $request->validez;
            }


        }
        else{
            $respuesta->validez = $request->validez;
        }
        
       
        $respuesta->estado = $request->estado;

        if(count(respuesta::where('id_pregunta', $id_pregunta)->get()) == 4){
            return redirect(route('respuestas.index', ['id_pregunta' => $id_pregunta]))->withErrors('El máximo de respuestas permitidas es de cuatro');
        }

        

        $respuesta->save();
    
        return redirect(route('respuestas.index',  ['id_pregunta' => $id_pregunta]))->with('success','Registro ingresado con éxito');
    }
    
    public function show($id_pregunta, $id){
        $respuesta = respuesta::find($id);
        return view('respuestas.show', ['id_pregunta' => $id_pregunta, 'respuesta' => $respuesta ]);
    }
    
    public function edit($id_pregunta, $id){
        $respuesta = respuesta::find($id);
        return view('respuestas.edit', ['id_pregunta' => $id_pregunta,'respuesta' => $respuesta]);
    }
    
    public function update(Request $request, $id_pregunta, $id){
        $request->validate([
            'respuesta' => 'required',
            'validez' => 'required',
            'estado' => 'required',
        ]);
    
        $respuesta = respuesta::find($id);
        $respuesta->respuesta = $request->respuesta;
        $respuesta->id_pregunta = $id_pregunta;
        $unica_correcta = respuesta::where('id_pregunta', $id_pregunta)->where('validez', 'Correcta')->first();
        if(isset($unica_correcta)){
            if($unica_correcta->validez == $request->validez){

                if($unica_correcta->id == $respuesta->id){
                     $respuesta->validez = $request->validez;

                }
                else{
                    return redirect(route('respuestas.index', ['id_pregunta' => $id_pregunta]))->withErrors('Solo puede haber una respuesta correcta');

                }

               
            }
            else{
                $respuesta->validez = $request->validez;
            }


        }
        else{
            $respuesta->validez = $request->validez;
        }
        
       
        $respuesta->estado = $request->estado;

        

        $respuesta->save();
    
        return redirect(route('respuestas.index',  ['id_pregunta' => $id_pregunta]))->with('success','Registro actualizado con éxito');
    }
    
    public function destroy($id_pregunta, $id){
        respuesta::find($id)->delete();
        return redirect(route('respuestas.index',  ['id_pregunta' => $id_pregunta]))->with('success','Registro eliminado con éxito');
    }
}
