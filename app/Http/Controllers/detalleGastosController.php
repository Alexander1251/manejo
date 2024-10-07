<?php

namespace App\Http\Controllers;

use App\Models\detalleGasto;
use App\Models\gasto;
use Illuminate\Http\Request;

class detalleGastosController extends Controller
{
    public function index(){
        $detalles = detalleGasto::all();
        $gastos = gasto::all();

        return view('detalle-gastos.index', ['gastos' => $gastos, 'detalles' => $detalles]);
    }

    public function store(Request $request){

       

        $request->validate([
            'numero_factura' =>  'required',
            'id_tipo' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'iva' => 'required',
        ]);

        $detalle = new detalleGasto();

        $detalle->numero_factura = $request->numero_factura;
        $detalle->id_tipo = $request->id_tipo;
        $detalle->monto = $request->monto;
        if($request->iva == 'Si'){
            $detalle->iva = round($request->monto*0.13,2);
            $detalle->total = round($request->monto + $request->monto*0.13,2);

        }
        else{
            $detalle->iva = round(0,2);
            $detalle->total = round($request->monto,2);
        }
       
        $detalle->descripcion = $request->descripcion;
        $detalle->fecha = $request->fecha;
        $detalle->save();

        return redirect(route('detalle-gastos.index'))->with('success', 'Se ha ingresado el registro correctamente');



    }

    public function edit($id){
        $detalle = detalleGasto::find($id);
        $gastos = gasto::all();


        

   

        return view('detalle-gastos.edit', ['detalle' => $detalle, 'gastos' => $gastos]);
    }

    
    public function update(Request $request, $id){

        $request->validate([
            'numero_factura' =>  'required',
            'id_tipo' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required',
            'iva' => 'required',
        ]);

        $detalle = detalleGasto::find($id);

        $detalle->numero_factura = $request->numero_factura;
        $detalle->id_tipo = $request->id_tipo;
        $detalle->monto = $request->monto;
        if($request->iva == 'Si'){
            $detalle->iva = round($request->monto*0.13,2);
            $detalle->total = round($request->monto + $request->monto*0.13,2);

        }
        else{
            $detalle->iva = round(0,2);
            $detalle->total = round($request->monto,2);
        }
        $detalle->descripcion = $request->descripcion;
        $detalle->fecha = $request->fecha;
        $detalle->save();

        return redirect(route('detalle-gastos.index'))->with('success', 'Se ha actualizado el registro correctamente');



    }

    public function destroy($id){
        detalleGasto::find($id)->delete();

        return redirect(route('detalle-gastos.index'))->with('success', 'Se ha eliminado el registro correctamente');
    }

    public function show($id){
        $detalle = detalleGasto::find($id);
        $gastos = gasto::all();

        return view('detalle-gastos.show', [ 'detalle' => $detalle ,'gastos' => $gastos]);
    }
}
