<?php

namespace App\Http\Controllers;

use App\Models\practicoCategoria;
use Illuminate\Http\Request;

class practicoCategoriaController extends Controller
{
    public function index(){
        $categorias = practicoCategoria::all();
        return view('practico-categorias.index', ['categorias' => $categorias]);
    }
    
    public function store(Request $request){
        $request->validate([
            'categoria' => 'required',
            
        ]);
    
        $categoria = new practicoCategoria();
        $categoria->categoria = $request->categoria;

        $categoria->save();
    
        return redirect(route('practico-categorias.index'))->with('success','Registro ingresado con éxito');
    }
    
    public function show($id){
        $categoria = practicoCategoria::find($id);
        return view('practico-categorias.show', ['categoria' => $categoria]);
    }
    
    public function edit($id){
        $categoria = practicoCategoria::find($id);
        return view('practico-categorias.edit', ['categoria' => $categoria]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'categoria' => 'required',
          
        ]);
    
        $categoria = practicoCategoria::find($id);
        $categoria->categoria = $request->categoria;
   
        $categoria->save();
    
        return redirect(route('practico-categorias.index'))->with('success','Registro actualizado con éxito');
    }
    
    public function destroy($id){
        practicoCategoria::find($id)->delete();
        return redirect(route('practico-categorias.index'))->with('success','Registro eliminado con éxito');
    }
}
