<?php

namespace App\Http\Controllers;

use App\Models\examen;
use App\Models\expediente;
use App\Models\practicoCategoria;
use App\Models\practicoDetalle;
use App\Models\practicoPreguntas;
use App\Models\pruebaPractica;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\App;

class pruebaPracticaController extends Controller
{
    public function index()
    {

        $examenes = pruebaPractica::all();
        return view('prueba-practica.index', ['examenes' => $examenes]);
    }

    public function create()
    {
        $clientes = usuario::whereHas('expediente', function($query){
            $query->where('estado', 'Activo')->whereDoesntHave('pruebaPractica');
        })->where('id_rol', '2')->get();
        $preguntas = practicoPreguntas::all();
        $categorias = practicoCategoria::all();

        return view('prueba-practica.form', ['preguntas' => $preguntas, 'categorias' => $categorias, 'clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',


        ]);

     
        

        $examen = new pruebaPractica();
        $expediente = expediente::where('id_cliente', $request->id_cliente)->where('estado', 'Activo')->get()->first();
        $preguntas = practicoPreguntas::all();
        $examen->id_expediente = $expediente->id;
        $contador = 0;

        foreach ($preguntas as $pregunta) {
            if ($request->input('pregunta' . $pregunta->id) == 'Si') {
                $contador++;
            }
        }

       
        $examen->calificacion = ($contador / sizeof($preguntas)) * 10;
        $examen->estado = "Finalizado";
        $examen->id_examinador = auth()->user()->id;
        if ($examen->calificacion >= 7) {
          
            $expediente->estado_examen_practico = 'Aprobado';
            $expediente->save();
        } else {
          
            $expediente->estado_examen_practico = 'Reprobado';
            $expediente->save();
        }
        $examen->save();

        foreach ($preguntas as $pregunta) {
            $detalle = new practicoDetalle();
            $detalle->id_examen = $examen->id;
            $detalle->id_pregunta = $pregunta->id;
            $detalle->resultado = $request->input('pregunta' . $pregunta->id);
            $detalle->save();

           
        }

       

        return redirect(route('prueba-practica.index'))->with('success', 'Registro ingresado con éxito');
    }

    public function show($id){
        $detalles = practicoDetalle::where('id_examen', $id)->get();

        $examen = pruebaPractica::find($id);
        return view('prueba-practica.show', ['detalles' => $detalles, 'examen' => $examen]);
    }

    public function destroy($id){
        pruebaPractica::find($id)->delete();

        return redirect(route('prueba-practica.index'))->with('success', 'Registro eliminado con éxito');
    }

    public function generarDetallePDF($id){
        $examen = pruebaPractica::find($id);


  
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

       
        $pdf->loadView('prueba-practica.detallePDF', ['examen' => $examen]);
        $pdf->render();
        return $pdf->stream();
    }
}
