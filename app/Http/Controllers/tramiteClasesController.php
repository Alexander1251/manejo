<?php

namespace App\Http\Controllers;

use App\Models\tramiteClase;
use Illuminate\Http\Request;

class tramiteClasesController extends Controller
{
    public function index(){
        $tramite_clases = tramiteClase::all();
        return view('tramite-clases.index', ['tramite_clases' => $tramite_clases]);
    }

    public function store(Request $request){
        $request->validate([
            'tramite' => 'required',
            'estado' => 'required',
        ]);

        $tramite_clase = new tramiteClase();
        $tramite_clase->tramite = $request->tramite;
        $tramite_clase->estado = $request->estado;
        $tramite_clase->save();

        return redirect(route('tramite-clases.index'))->with('success','Registro ingresado con éxito');

    }

    public function show($id){
        $tramite_clase = tramiteClase::find($id);
        return view('tramite-clases.show', ['tramite_clase' => $tramite_clase ]);

    }

    public function edit($id){
        $tramite_clase = tramiteClase::find($id);
        return view('tramite-clases.edit', ['tramite_clase' => $tramite_clase]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'tramite' => 'required',
            'estado' => 'required',
        ]);

        $tramite_clase = tramiteClase::find($id);
        $tramite_clase->tramite = $request->tramite;
        $tramite_clase->estado = $request->estado;
        $tramite_clase->save();

        return redirect(route('tramite-clases.index'))->with('success','Registro actualizado con éxito');
    }

    public function destroy($id){
        tramiteClase::find($id)->delete();
        return redirect(route('tramite-clases.index'))->with('success','Registro eliminado con éxito');


    }
}
