<?php

namespace App\Http\Controllers;

use App\Models\detalleIngreso;
use App\Models\empresaDatos;
use App\Models\escuela;
use App\Models\ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class detalleIngresosController extends Controller
{
    public function index(){
        $detalles = detalleIngreso::all();
        $ingresos = ingreso::all();
        $escuelas = escuela::all();

        return view('detalle-ingresos.index', ['escuelas'=> $escuelas,'ingresos' => $ingresos, 'detalles' => $detalles]);
    }

    public function store(Request $request){

       

        $request->validate([
            'numero_factura' =>  'required| unique:detalle_ingresos',
            'id_ingreso' => 'required',
            'cantidad' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required',
            
            'direccion' => 'required',
            'municipio' => 'required',
            'departamento' => 'required',
            
            'id_procedencia' => 'required',
            'fecha' => 'required'
        ]);

        $detalle = new detalleIngreso();
        $ingreso = ingreso::find($request->id_ingreso);

        $detalle->numero_factura = $request->numero_factura;
        $detalle->id_ingreso = $request->id_ingreso;
        $detalle->cantidad = $request->cantidad;
        $detalle->monto = $ingreso->precio;
      
        $detalle->total = round($request->cantidad*$ingreso->precio,2);
        $detalle->id_procedencia = $request->id_procedencia;
        $detalle->fecha = $request->fecha;
        $detalle->nombres = $request->nombres;
        $detalle->apellidos = $request->apellidos;
        $detalle->dui = $request->dui;
        $detalle->direccion = $request->direccion;
        $detalle->municipio = $request->municipio;
        $detalle->departamento = $request->departamento;


        if(isset($request->nit) && $request->nit != null){
            $detalle->nit = $request->nit;


        }

        if(isset($request->nrc) && $request->nrc != null){
            $detalle->nrc = $request->nrc;


        }

        if(isset($request->giro) && $request->giro != null){
            $detalle->giro = $request->giro;


        }

        $detalle->save();

        return redirect(route('detalle-ingresos.index'))->with('success', 'Se ha ingresado el registro correctamente');



    }

    public function edit($id){
        $detalle = detalleIngreso::find($id);
        $ingresos = ingreso::all();
        $escuelas = escuela::all();


        

   

        return view('detalle-ingresos.edit', ['escuelas'=> $escuelas,'detalle' => $detalle, 'ingresos' => $ingresos]);
    }

    
    public function update(Request $request, $id){

        $request->validate([
            'numero_factura' =>   ['required',  Rule::unique('detalle_ingresos')->ignore($id)],
            'id_ingreso' => 'required',
            'cantidad' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required',
           
            'direccion' => 'required',
            'municipio' => 'required',
            'departamento' => 'required',
           
            'id_procedencia' => 'required',
            'fecha' => 'required'
        ]);

        $detalle = detalleIngreso::find($id);
        $ingreso = ingreso::find($request->id_ingreso);
        $detalle->numero_factura = $request->numero_factura;
        $detalle->id_ingreso = $request->id_ingreso;
        $detalle->cantidad = $request->cantidad;
        $detalle->monto = $ingreso->precio;
      
        $detalle->total = round($request->cantidad*$ingreso->precio,2);
        $detalle->id_procedencia = $request->id_procedencia;
        $detalle->fecha = $request->fecha;
        $detalle->nombres = $request->nombres;
        $detalle->apellidos = $request->apellidos;
        $detalle->dui = $request->dui;
        $detalle->direccion = $request->direccion;
        $detalle->municipio = $request->municipio;
        $detalle->departamento = $request->departamento;


        if(isset($request->nit) && $request->nit != null){
            $detalle->nit = $request->nit;


        }

        if(isset($request->nrc) && $request->nrc != null){
            $detalle->nrc = $request->nrc;


        }

        if(isset($request->giro) && $request->giro != null){
            $detalle->giro = $request->giro;


        }
        $detalle->save();

        return redirect(route('detalle-ingresos.index'))->with('success', 'Se ha actualizado el registro correctamente');



    }

    public function destroy($id){
        detalleIngreso::find($id)->delete();

        return redirect(route('detalle-ingresos.index'))->with('success', 'Se ha eliminado el registro correctamente');
    }

    public function show($id){
        $detalle = detalleIngreso::find($id);
        

        return view('detalle-ingresos.show', [ 'detalle' => $detalle]);
    }

    public function generarFacturaPdf($id)
    {
        $detalle = detalleIngreso::find($id);

        $empresaDatos = empresaDatos::all()->first();
        $path = 'imgExpedientes/' . $empresaDatos->logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $pdf->loadView('detalle-ingresos.factura', ['detalle' => $detalle, 'foto' => $base64, 'empresaDatos' => $empresaDatos]);
        $pdf->render();
        return $pdf->stream();
    }

    public function generarCreditoFiscal($id)
    {
        $detalle = detalleIngreso::find($id);

        $empresaDatos = empresaDatos::all()->first();
        $path = 'imgExpedientes/' . $empresaDatos->logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $pdf->loadView('detalle-ingresos.credito-fiscal', ['detalle' => $detalle, 'foto' => $base64, 'empresaDatos' => $empresaDatos]);
        $pdf->render();
        return $pdf->stream();
    }
}
