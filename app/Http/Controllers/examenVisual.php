<?php

namespace App\Http\Controllers;

use App\Models\expediente;
use Illuminate\Http\Request;

class examenVisual extends Controller
{
    public function index(){
        $expedientes = expediente::where('estado', 'Activo')->get();

        return view('visuales.index', ['expedientes' => $expedientes]);
    }

    public function edit($id){
        $expediente = expediente::find($id);
        
       
        return view('visuales.edit', ['expediente' => $expediente]);
    }

    public function update(Request $request, $id){
        $request->validate([
            
            'fecha_examen_visual' => 'required',
            'estado_examen_visual' => 'required',
       
        ]);

        $expediente = expediente::find($id);
   
        $expediente->fecha_examen_visual = $request->fecha_examen_visual;
        $expediente->estado_examen_visual = $request->estado_examen_visual;
       
       
        $expediente->save();

        return redirect(route('visuales.index'))->with('success','Registro actualizado con éxito');

    }

    public function show($id){

        $expediente = expediente::find($id);

        return view('visuales.show',  ['expediente' => $expediente]);
    }
}
