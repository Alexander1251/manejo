<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class categoriasController extends Controller
{
    public function index(){
        $categorias = categoria::all();
        return view('categorias.index', ['categorias' => $categorias]);
    }
    
    public function store(Request $request){
        $request->validate([
            'categoria' => 'required',
            'estado' => 'required',
        ]);
    
        $categoria = new categoria();
        $categoria->categoria = $request->categoria;
        $categoria->estado = $request->estado;
        $categoria->save();
    
        return redirect(route('categorias.index'))->with('success','Registro ingresado con éxito');
    }
    
    public function show($id){
        $categoria = categoria::find($id);
        return view('categorias.show', ['categoria' => $categoria]);
    }
    
    public function edit($id){
        $categoria = categoria::find($id);
        return view('categorias.edit', ['categoria' => $categoria]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'categoria' => 'required',
            'estado' => 'required',
        ]);
    
        $categoria = categoria::find($id);
        $categoria->categoria = $request->categoria;
        $categoria->estado = $request->estado;
        $categoria->save();
    
        return redirect(route('categorias.index'))->with('success','Registro actualizado con éxito');
    }
    
    public function destroy($id){
        categoria::find($id)->delete();
        return redirect(route('categorias.index'))->with('success','Registro eliminado con éxito');
    }
}
