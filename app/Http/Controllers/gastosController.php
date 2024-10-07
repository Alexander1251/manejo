<?php

namespace App\Http\Controllers;

use App\Models\gasto;
use Illuminate\Http\Request;
use PDO;

class gastosController extends Controller
{
    public function index(){
        $gastos = gasto::all();

        return view('gastos.index', ['gastos' => $gastos]);
    }

    public function store(Request $request){

        $gasto = new gasto();

        $request->validate([
            'tipo' => 'required',
        ]);

        $gasto->tipo = $request->tipo;
        $gasto->save();

        return redirect(route('gastos.index'))->with('success', 'Se ha ingresado el registro correctamente');



    }

    public function edit($id){
        $gasto = gasto::find($id);

        

   

        return view('gastos.edit', ['gasto' => $gasto]);
    }

    
    public function update(Request $request, $id){

        $gasto = gasto::find($id);

        $request->validate([
            'tipo' => 'required',
        ]);

        $gasto->tipo = $request->tipo;
        $gasto->save();

        return redirect(route('gastos.index'))->with('success', 'Se ha actualizado el registro correctamente');



    }

    public function destroy($id){
        gasto::find($id)->delete();

        return redirect(route('gastos.index'))->with('success', 'Se ha eliminado el registro correctamente');
    }

    public function show($id){
        $gasto = gasto::find($id);

        return view('gastos.show', ['gasto' => $gasto]);
    }
}
