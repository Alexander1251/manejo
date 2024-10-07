<?php

namespace App\Http\Controllers;

use App\Models\licenciaTipo;
use Illuminate\Http\Request;

class licenciaTiposController extends Controller
{
    public function index(){
      $licencia_tipos = licenciaTipo::all();
      return view('licencia-tipos.index', ['licencia_tipos' => $licencia_tipos]);
    }

    public function store(Request $request){
        $request->validate([
            'licencia' => 'required',
            'estado' => 'required',
        ]);

        $licencia_tipo = new licenciaTipo();
        $licencia_tipo->licencia = $request->licencia;
        $licencia_tipo->estado = $request->estado;
        $licencia_tipo->save();

        return redirect(route('licencia-tipos.index'))->with('success','Registro ingresado con éxito');

    }

    public function show($id){
        $licencia_tipo = licenciaTipo::find($id);
        return view('licencia-tipos.show', ['licencia_tipo' => $licencia_tipo]);
        
    }

    public function edit($id){
        $licencia_tipo = licenciaTipo::find($id);
        return view('licencia-tipos.edit', ['licencia_tipo' => $licencia_tipo]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'licencia' => 'required',
            'estado' => 'required',
        ]);

        $licencia_tipo = licenciaTipo::find($id);
        $licencia_tipo->licencia = $request->licencia;
        $licencia_tipo->estado = $request->estado;
        $licencia_tipo->save();

        return redirect(route('licencia-tipos.index'))->with('success','Registro actualizado con éxito');

    }

    public function destroy($id){
        licenciaTipo::find($id)->delete();
        return redirect(route('licencia-tipos.index'))->with('success','Registro eliminado con éxito');

    }
}
