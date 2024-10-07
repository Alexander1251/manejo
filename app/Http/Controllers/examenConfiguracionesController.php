<?php

namespace App\Http\Controllers;

use App\Models\examenConfiguracion;
use Illuminate\Http\Request;

class examenConfiguracionesController extends Controller
{
    public function index(){
        $examenConfiguraciones = examenConfiguracion::all();

        return view('examenConfiguraciones.index', ['examenConfiguraciones' => $examenConfiguraciones]);

    }

    public function show($id){
        $examenConfiguracion = examenConfiguracion::find($id);

        return view('examenConfiguraciones.show', ['examenConfiguracion' => $examenConfiguracion]);

    }

    public function destroy($id){
        examenConfiguracion::find($id)->delete();

        return redirect(route('examen-configuraciones.index'))->with('success','Registro eliminado con éxito');

    }

    public function edit($id){
        $examenConfiguracion = examenConfiguracion::find($id);

        return view('examenConfiguraciones.edit', ['examenConfiguracion' => $examenConfiguracion]);

    }

    public function store(Request $request){
        $request->validate([
            'titulo' => 'required',
            'nota_aprobada' => 'required',
            'nota_maxima' => 'required',
            'tiempo_examen' => 'required',
            'estado' => 'required',
            'total_preguntas' => 'required',
        ]);

        if(sizeof(examenConfiguracion::all()) > 0 ){
            return redirect(route('examen-configuraciones.index'))->withErrors('Solo se permite una configuración, edite o elimne la actual');
        }

        $examenConfiguracion = new examenConfiguracion();
        $examenConfiguracion->titulo = $request->titulo;
        $examenConfiguracion->nota_aprobada = $request->nota_aprobada;
        $examenConfiguracion->nota_maxima = $request->nota_maxima;
        $examenConfiguracion->tiempo_examen = $request->tiempo_examen;
        $examenConfiguracion->estado = $request->estado;
        $examenConfiguracion->total_preguntas = $request->total_preguntas;
        $examenConfiguracion->save();

        return redirect(route('examen-configuraciones.index'))->with('success','Registro ingresado con éxito');
    }

    public function update(Request $request, $id){
        $request->validate([
            'titulo' => 'required',
            'nota_aprobada' => 'required',
            'nota_maxima' => 'required',
            'tiempo_examen' => 'required',
            'estado' => 'required',
            'total_preguntas' => 'required',
        ]);

        $examenConfiguracion = examenConfiguracion::find($id);
        $examenConfiguracion->titulo = $request->titulo;
        $examenConfiguracion->nota_aprobada = $request->nota_aprobada;
        $examenConfiguracion->nota_maxima = $request->nota_maxima;
        $examenConfiguracion->tiempo_examen = $request->tiempo_examen;
        $examenConfiguracion->estado = $request->estado;
        $examenConfiguracion->total_preguntas = $request->total_preguntas;
        $examenConfiguracion->save();

        return redirect(route('examen-configuraciones.index'))->with('success','Registro actualizado con éxito');
    }



    
}
