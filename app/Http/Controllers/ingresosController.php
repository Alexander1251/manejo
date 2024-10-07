<?php

namespace App\Http\Controllers;

use App\Models\ingreso;
use Illuminate\Http\Request;

class ingresosController extends Controller
{
    public function index(){
        $ingresos = ingreso::all();

        return view('ingresos.index', ['ingresos' => $ingresos]);
    }

    public function store(Request $request){

        $ingreso = new ingreso();

        $request->validate([
            'ingreso' => 'required',
            'precio' => 'required',
            'expediente' => 'required'
        ]);

        $ingreso->ingreso = $request->ingreso;
        $ingreso->precio = $request->precio;
        $ingreso->expediente = $request->expediente;
        $ingreso->save();

        return redirect(route('ingresos.index'))->with('success', 'Se ha ingresado el registro correctamente');



    }

    public function edit($id){
        $ingreso = ingreso::find($id);

        

   

        return view('ingresos.edit', ['ingreso' => $ingreso]);
    }

    
    public function update(Request $request, $id){

        $ingreso = ingreso::find($id);

        $request->validate([
            'ingreso' => 'required',
            'precio' => 'required',
            'expediente' => 'required'
        ]);

        $ingreso->ingreso = $request->ingreso;
        $ingreso->precio = $request->precio;
        $ingreso->expediente = $request->expediente;
        $ingreso->save();

        return redirect(route('ingresos.index'))->with('success', 'Se ha actualizado el registro correctamente');



    }

    public function destroy($id){
        ingreso::find($id)->delete();

        return redirect(route('ingresos.index'))->with('success', 'Se ha eliminado el registro correctamente');
    }

    public function show($id){
        $ingreso = ingreso::find($id);

        return view('ingresos.show', ['ingreso' => $ingreso]);
    }
}
