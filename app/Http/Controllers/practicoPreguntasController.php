<?php

namespace App\Http\Controllers;

use App\Models\practicoCategoria;
use App\Models\practicoPreguntas;
use Illuminate\Http\Request;

class practicoPreguntasController extends Controller
{
    public function index(){
        $preguntas = practicoPreguntas::all();
        $categorias = practicoCategoria::all();
        return view('practico-preguntas.index', ['preguntas' => $preguntas, 'categorias' => $categorias]);
    }
    
    public function store(Request $request){
        $request->validate([
            'pregunta' => 'required',
            'id_categoria' => 'required'
            
        ]);
    
        $pregunta = new practicoPreguntas();
        $pregunta->pregunta = $request->pregunta;
        $pregunta->id_categoria = $request->id_categoria;

        $pregunta->save();
    
        return redirect(route('practico-preguntas.index'))->with('success','Registro ingresado con éxito');
    }
    
    public function show($id){
        $pregunta = practicoPreguntas::find($id);
        return view('practico-preguntas.show', ['pregunta' => $pregunta]);
    }
    
    public function edit($id){
        $pregunta = practicoPreguntas::find($id);
        $categorias = practicoCategoria::all();
        return view('practico-preguntas.edit', ['pregunta' => $pregunta, 'categorias' => $categorias]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'pregunta' => 'required',
            'id_categoria' => 'required'
          
        ]);
    
        $pregunta = practicoPreguntas::find($id);
        $pregunta->pregunta = $request->pregunta;
        $pregunta->id_categoria = $request->id_categoria;
   
        $pregunta->save();
    
        return redirect(route('practico-preguntas.index'))->with('success','Registro actualizado con éxito');
    }
    
    public function destroy($id){
        practicoPreguntas::find($id)->delete();
        return redirect(route('practico-preguntas.index'))->with('success','Registro eliminado con éxito');
    }
}
