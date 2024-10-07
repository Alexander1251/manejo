<?php

namespace App\Http\Controllers;

use App\Exports\detalleGastosExcel;
use App\Exports\detalleIngresosExcel;
use App\Exports\reporteGastosExcel;
use App\Exports\reporteIngresosExcel;
use App\Models\detalleGasto;
use App\Models\detalleIngreso;
use App\Models\escuela;
use App\Models\examen;
use App\Models\examenConfiguracion;
use App\Models\expediente;
use App\Models\gasto;
use App\Models\ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class reportesController extends Controller
{
    public function reporteIngresos()
    {


        return view('reportes.ingresos');
    }

    public function reporteGastos()
    {


        return view('reportes.gastos');
    }

    public function buscarIngresos(Request $request)
    {
        setlocale(LC_ALL, 'es_ES');
        $request->validate([
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
        ]);

        $detalles = detalleIngreso::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();

        return view('reportes.ingresos', ['detalles' => $detalles,  'fechaInicio' => $request->fechaInicio, 'fechaFin' => $request->fechaFin]);
    }

    public function buscarGastos(Request $request)
    {
        setlocale(LC_ALL, 'es_ES');
        $request->validate([
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
        ]);

        $detalles = detalleGasto::whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();


        return view('reportes.gastos', ['detalles' => $detalles, 'fechaInicio' => $request->fechaInicio, 'fechaFin' => $request->fechaFin]);
    }

    public function detalleIngresos()
    {
        $escuelas = escuela::all();

        return view('reportes.detalle-ingresos', ['escuelas' => $escuelas]);
    }

    public function detalleGastos()
    {
        return view('reportes.detalle-gastos');
    }

    public function buscarDetalleGastos(Request $request)
    {

        $request->validate([
            'fecha' => 'required',

        ]);

        $diarios = [];



        $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($request->fecha)), date('Y', strtotime($request->fecha)));

        $gastos = gasto::all();
        foreach ($gastos as $gasto) {

            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día


                // Sumatoria de registrosG para el día
                $total = detalleGasto::where('id_tipo', $gasto->id)->where('fecha', $request->fecha . '-' . $dia)->sum('total');

                // Calcular la diferencia


                // Almacenar los resultados en el array diario
                $diarios[$gasto->id][$dia] = [
                    'fecha' => $request->fecha . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT),

                    'total' => $total,

                ];
            }
        }




        return view('reportes.detalle-gastos', ['gastos' => $gastos, 'diarios' => $diarios, 'fecha' => $request->fecha]);
    }

    public function buscarDetalleIngresos(Request $request)
    {
        $request->validate([
            'fecha' => 'required',

        ]);

        $escuelaF = escuela::find($request->escuela);

        $escuelas = escuela::all();



        $diasDelMes = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($request->fecha)), date('Y', strtotime($request->fecha)));


        $ingresos = ingreso::all();
        foreach ($ingresos as $ingreso) {

            for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                // Sumatoria de registrosI para el día


                // Sumatoria de registrosG para el día

                if (isset($request->escuela) && $request->escuela != 'Todas') {
                    $total = detalleingreso::where('id_procedencia', $request->escuela)->where('id_ingreso', $ingreso->id)->where('fecha', $request->fecha . '-' . $dia)->sum('total');
                    $cantidad = detalleingreso::where('id_procedencia', $request->escuela)->where('id_ingreso', $ingreso->id)->where('fecha', $request->fecha . '-' . $dia)->count();
                } else {
                    $total = detalleingreso::where('id_ingreso', $ingreso->id)->where('fecha', $request->fecha . '-' . $dia)->sum('total');
                    $cantidad = detalleingreso::where('id_ingreso', $ingreso->id)->where('fecha', $request->fecha . '-' . $dia)->count();
                }
                // Calcular la diferencia


                // Almacenar los resultados en el array diario
                $diarios[$ingreso->id][$dia] = [
                    'fecha' => $request->fecha . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT),
                    'cantidad' => $cantidad,
                    'total' => $total,

                ];
            }
        }




        return view('reportes.detalle-ingresos', ['ingresos' => $ingresos, 'diarios' => $diarios, 'fecha' => $request->fecha, 'escuelas' => $escuelas, 'escuelaF' => $escuelaF]);
    }

    public function resultados(){
        return view('reportes.resultados');
    }

    public function buscarResultados(Request $request){
        setlocale(LC_ALL, 'es_ES');
        $request->validate([
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'estatus' => 'required'
        ]);

        $configuracion = examenConfiguracion::all()->first();
        if($request->estatus == 'Aprobados'){
            $clientes = examen::where('calificacion', '>=', $configuracion->nota_aprobada)->whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();
        }
        else{
            $clientes = examen::where('calificacion', '<', $configuracion->nota_aprobada)->whereBetween('fecha', [$request->fechaInicio, $request->fechaFin])->get();
        }
        
        return $clientes;
        
        return view('reportes.resultados', ['clientes' => $clientes, 'estatus' => $request->estatus, 'fechaInicio' => $request->fechaInicio, 'fechaFin' => $request->fechaFin]);

        

    }

    public function detalleGastosExcel($fecha)
    {

        return Excel::download(new detalleGastosExcel($fecha), 'detalle_gastos.xlsx');
    }

    public function detalleIngresosExcel($fecha, $escuela)
    {

        return Excel::download(new detalleIngresosExcel($fecha, $escuela), 'detalle_ingresos.xlsx');
    }

    public function gastosExcel($fecha_inicio, $fecha_fin)
    {

        return Excel::download(new reporteGastosExcel($fecha_inicio, $fecha_fin), 'reporte_gastos.xlsx');
    }

    public function IngresosExcel($fecha_inicio, $fecha_fin)
    {

        return Excel::download(new reporteIngresosExcel($fecha_inicio, $fecha_fin), 'reporte_ingresos.xlsx');
    }
}
