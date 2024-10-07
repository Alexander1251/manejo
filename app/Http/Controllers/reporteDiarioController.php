<?php

namespace App\Http\Controllers;

use App\Exports\reporteDiarioExcel;
use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use App\Models\expediente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class reporteDiarioController extends Controller
{
    public function index(){

        return view('reporte-diario.reporte');
    }

    public function buscarReporte(Request $request){
       

        $detalles = detalleGasto::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();
      
        $totalI = detalleIngreso::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->sum('total');
        $totalG = detalleGasto::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->sum('total');
        $ingresos = detalleIngreso::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();

        return view('reporte-diario.reporte', ['ingresos' => $ingresos,'detalles' => $detalles, 'fechaInicio' => $request->fechaInicio, 'fechaFin' => $request->fechaFin, 'totalG' => $totalG,  'totalI' => $totalI]);
    }

    public function reporteExcel($fecha_inicio, $fecha_fin){

        return Excel::download(new reporteDiarioExcel($fecha_inicio, $fecha_fin), 'reporte_diario.xlsx');

    }

    
}


