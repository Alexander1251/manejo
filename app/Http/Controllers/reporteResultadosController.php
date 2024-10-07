<?php

namespace App\Http\Controllers;

use App\Exports\reporteResultadosExcel;
use App\Models\examen;
use App\Models\examenConfiguracion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class reporteResultadosController extends Controller
{
    public function index()
    {

        return view('reportes.resultados');
    }

    public function buscarResultados(Request $request)
    {
        $request->validate([
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'estatus' => 'required'
        ]);

        $configuracion = examenConfiguracion::all()->first();
        if ($request->estatus == 'Aprobados') {
            $clientes = examen::where('calificacion', '>=', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$request->fechaInicio, $request->fechaFin])->get();
        } else {
            $clientes = examen::where('calificacion', '<', $configuracion->nota_aprobada)->whereBetween('fecha_examen', [$request->fechaInicio, $request->fechaFin])->get();
        }

        return view('reportes.resultados', ['clientes' => $clientes, 'estatus' => $request->estatus, 'fechaInicio' => $request->fechaInicio, 'fechaFin' => $request->fechaFin]);
    }

    public function resultadosExcel($fecha_inicio, $fecha_fin, $estatus)
    {
      

        return Excel::download(new reporteResultadosExcel($fecha_inicio, $fecha_fin, $estatus), 'reporte_resultados.xlsx');
    }
}
