<?php

namespace App\Http\Controllers;

use App\Models\escuela;
use Illuminate\Http\Request;

class escuelasController extends Controller
{
    public function index()
    {
        $escuelas = escuela::all();

        return view('escuelas.index', ['escuelas' => $escuelas]);
    }

    public function store(Request $request)
    {

        $escuela = new escuela();

        $request->validate([
            'escuela' => 'required',
        ]);

        $escuela->escuela = $request->escuela;
        $escuela->save();

        return redirect(route('escuelas.index'))->with('success', 'Se ha ingresado el registro correctamente');
    }

    public function edit($id)
    {
        $escuela = escuela::find($id);





        return view('escuelas.edit', ['escuela' => $escuela]);
    }


    public function update(Request $request, $id)
    {

        $escuela = escuela::find($id);

        $request->validate([
            'escuela' => 'required',
        ]);

        $escuela->escuela = $request->escuela;
        $escuela->save();

        return redirect(route('escuelas.index'))->with('success', 'Se ha actualizado el registro correctamente');
    }

    public function destroy($id)
    {
        escuela::find($id)->delete();

        return redirect(route('escuelas.index'))->with('success', 'Se ha eliminado el registro correctamente');
    }

    public function show($id)
    {
        $escuela = escuela::find($id);

        return view('escuelas.show', ['escuela' => $escuela]);
    }
}
