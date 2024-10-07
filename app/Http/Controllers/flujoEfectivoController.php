<?php

namespace App\Http\Controllers;

use App\Exports\flujoEfectivoExcel;
use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use App\Models\expediente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class flujoEfectivoController extends Controller
{
    public function index()
    {

        return view('reportes.flujo-efectivo');
    }

    public function flujoEfectivo(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
        ]);

        $saldoInicial = detalleIngreso::whereMonth('fecha', date('m', strtotime('-1 month', strtotime($request->fecha))))
        ->whereYear('fecha', date('Y', strtotime('-1 month', strtotime('-1 month', strtotime($request->fecha)))))
        ->sum('total') - detalleGasto::whereMonth('fecha', date('m', strtotime('-1 month', strtotime($request->fecha))))
        ->whereYear('fecha', date('Y', strtotime('-1 month', strtotime($request->fecha))))->sum('total');

        $totalI =  detalleIngreso::whereMonth('fecha', date('m', strtotime($request->fecha)))
            ->whereYear('fecha', date('Y', strtotime($request->fecha)))
            ->sum('total');
        $totalG = detalleGasto::whereMonth('fecha', date('m', strtotime($request->fecha)))
            ->whereYear('fecha', date('Y', strtotime($request->fecha)))->sum('total');

            //return $registrosI;
            $diarios = []; // Array para almacenar los resultados

            // Obtener el número de días del mes
            $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($request->fecha)), date('Y', strtotime($request->fecha)));
            
            $acumulado = 0;
            // Iterar sobre cada día del mes
            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día

                $sumaI =  detalleIngreso::where('fecha', $request->fecha.'-'.$dia)->sum('total');
                // Sumatoria de registrosG para el día
                $sumaG = detalleGasto::where('fecha', $request->fecha.'-'.$dia)->sum('total');
                
                // Calcular la diferencia
                $diferencia = $sumaI - $sumaG;
                $acumulado = $acumulado + $diferencia;
                // Almacenar los resultados en el array diario
                $diarios[$dia] = [
                    'fecha' => $request->fecha.'-'.str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'sumaI' => $sumaI,
                    'sumaG' => $sumaG,
                    'acumulado' => $acumulado
                ];
            }
            
        


        return view('reportes.flujo-efectivo', ['diarios' => $diarios, 'fecha' => $request->fecha, 'totalI' => $totalI, 'totalG' => $totalG, 'saldoInicial' => $saldoInicial]);
    }

    public function reporteExcel($fecha){

        return Excel::download(new flujoEfectivoExcel($fecha), 'flujo_efectivo.xlsx');

    }
}
