<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\detalleExamen;
use App\Models\examen;
use App\Models\examenConfiguracion;
use App\Models\expediente;
use App\Models\pregunta;
use App\Models\pruebaPractica;
use App\Models\respuesta;
use App\Models\rol;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Livewire\Features\SupportAutoInjectedAssets\SupportAutoInjectedAssets;

use function Laravel\Prompts\alert;
use function PHPUnit\Framework\isNull;

class examenesController extends Controller
{
    public function index()
    {

        if (auth()->user()->id_rol != 2) {
            $examenes = examen::all();
        } else {

            $expediente = expediente::where('id_cliente', auth()->user()->id)->get()->first();
            if ($expediente == null) {
                return redirect(route('Inicio'))->with('message', "Para usar esta página primero debe poseer un expediente");
            }

            else{
                $examenes = examen::where('id_expediente', $expediente->id)->get();
            }
        }



        return view('examenes.index', ['examenes' => $examenes]);
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $examen = examen::find($id);

        $detalles = detalleExamen::where('id_examen', $examen->id)->get();

        $informacion = [];
        foreach ($detalles as $detalle) {
            $pregunta = pregunta::find($detalle->id_pregunta);
            $respuesta = respuesta::find($detalle->id_respuesta);
            $informacion[] = [
                "pregunta" => $pregunta,
                "respuesta" => $respuesta
            ];
        }


        return view('examenes.show', ['informacion' => $informacion, 'examen' => $examen]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        examen::find($id)->delete();

        return redirect(route('examenes.index'))->with('success', 'El registro ha sido eleminado con éxito');
    }

    public function buscar(Request $request)
    {

        $fecha_inicio =  $request->fechaInicio;
        $fecha_fin = $request->fechaFin;
        $configuracion = examenConfiguracion::all()->first();

        $titulo = 'Reporte de registros entre ' . $fecha_inicio . ' a ' . $fecha_fin;

        $examenesT = count(examen::whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $examenesP = count(pruebaPractica::whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $examenesTA = count(examen::where('calificacion', '>=', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $examenesTR = count(examen::where('calificacion', '<', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $examenesPA = count(pruebaPractica::where('calificacion', '>=', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $examenesPR = count(pruebaPractica::where('calificacion', '<', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$fecha_inicio, $fecha_fin])->get());
        $clientes = count(expediente::whereBetween('fecha', [$fecha_inicio, $fecha_fin])->get());
        $monto = expediente::whereBetween('fecha', [$fecha_inicio, $fecha_fin])->sum('monto');


        return view('Inicio', ['titulo' => $titulo, 'examenesT' => $examenesT, 'examenesTA' => $examenesTA, 'examenesTR' => $examenesTR, 'examenesP' => $examenesP, 'examenesPA' => $examenesPA, 'examenesPR' => $examenesPR, 'clientes' => $clientes, 'monto' => $monto, 'configuracion' => $configuracion]);
    }


    public function dashboard()
    {


        $configuracion = examenConfiguracion::get()->first();

        $examenesT = count(examen::whereYear('fecha_examen', date('Y'))->get());
        $examenesP = count(pruebaPractica::whereYear('fecha_examen', date('Y'))->get());
        $examenesTA = count(examen::where('calificacion', '>=', $configuracion->nota_aprobada)->whereYear('fecha_examen', date('Y'))->get());
        $examenesTR = count(examen::where('calificacion', '<', $configuracion->nota_aprobada)->whereYear('fecha_examen', date('Y'))->get());
        $examenesPA = count(pruebaPractica::where('calificacion', '>=', $configuracion->nota_aprobada)->whereYear('fecha_examen', date('Y'))->get());
        $examenesPR = count(pruebaPractica::where('calificacion', '<', $configuracion->nota_aprobada)->whereYear('fecha_examen', date('Y'))->get());
        $clientes = count(expediente::whereYear('fecha', date('Y'))->get());
        $monto = expediente::whereYear('fecha', date('Y'))->sum('monto');
        $titulo = 'Reportes obtenidos de los registro del año ' . date('Y');







        return view('Inicio', ['titulo' => $titulo, 'examenesT' => $examenesT, 'examenesTA' => $examenesTA, 'examenesTR' => $examenesTR, 'examenesP' => $examenesP, 'examenesPA' => $examenesPA, 'examenesPR' => $examenesPR, 'clientes' => $clientes, 'monto' => $monto, 'configuracion' => $configuracion]);
    }

    public function examenForm()
    {



        $configuracion = examenConfiguracion::get()->first();
        $examen = new examen();
        $expediente = expediente::where('estado', 'Activo')->where('id_cliente', auth()->user()->id)->first();

        if ($expediente == null) {
            return redirect(route('Inicio'))->with('message', 'Para hacer uso de los cuestionarios primero se debe generar un expediente');
        }

        if (examen::where('id_expediente', $expediente->id)->first()) {
            return redirect(route('Inicio'))->with('message', 'Usted ya ha realizado un intento en esta prueba, para realizar un segundo comuníquese con administración');
        }

        $examen->id_expediente = $expediente->id;
        $examen->total_preguntas = $configuracion->total_preguntas;
        $examen->total_respuestas_correctas = 0;
        $examen->estado = 'En proceso';
        $examen->save();


        $verificarPreguntas = pregunta::all();

        if (sizeof($verificarPreguntas) == 0) {
            return redirect(route('Inicio'))->with('message', 'No hay preguntas disponibles en este cuestionario por el momento');
        }

        if (sizeof($verificarPreguntas) < $configuracion->total_preguntas) {
            return redirect(route('Inicio'))->with('message', 'El número de preguntas ingresadas en el sistema es inferior al número designado en el formato de examen');
        }

        $preguntas = pregunta::inRandomOrder()->limit($configuracion->total_preguntas)->get();


        return view('quiz', ['examen' => $examen, 'totalP' => $configuracion->total_preguntas, 'tiempo' => $configuracion->tiempo_examen, 'preguntas' => $preguntas]);
    }

    public function generarDetallePDF($id)
    {
        $examen = examen::find($id);


        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        foreach ($examen->detalles as $detalle) {
            $path = 'imgPreguntas/' . $detalle->pregunta->imagen;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $imagenes[$detalle->id] = $base64;
        }
        $pdf->loadView('examenes.detallePDF', ['examen' => $examen, 'imagenes' => $imagenes]);
        $pdf->render();
        return $pdf->stream();
    }
    /*
    public function examenForm1()
    {
        $configuracion = examenConfiguracion::get()->first();
        $examen = new examen();
        $expediente = expediente::where('id_cliente', auth()->user()->id)->first();
        if ($expediente == null) {
            return redirect(route('Inicio'))->with('message', 'Para hacer uso de los cuestionarios primero se debe generar un expediente');
        }

        $examen->id_expediente = $expediente->id;




        $examen->total_preguntas = $configuracion->total_preguntas;
        $examen->total_respuestas_correctas = 0;
        $examen->estado = 'En proceso';
        $examen->save();




        $verificarPreguntas = pregunta::all();

        if (sizeof($verificarPreguntas) == 0) {
            return redirect(route('Inicio'))->with('message', 'No hay preguntas disponibles en este cuestionario por el momento');
        }

        if (sizeof($verificarPreguntas) < $configuracion->total_preguntas) {
            return redirect(route('Inicio'))->with('message', 'El número de preguntas ingresadas en el sistema es inferior al número designado en el formato de examen');
        }


        return view('quiz', ['examen' => $examen, 'totalP' => $configuracion->total_preguntas, 'tiempo' => $configuracion->tiempo_examen]);
    }*/
}
