<?php

namespace App\Http\Controllers;

use App\Models\empresaDatos;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class empresaDatosController extends Controller
{
    public function index(){

        $empresasDatos = empresaDatos::all();
        
        return view('empresa-datos.index', ['empresasDatos' => $empresasDatos]);
    }

    public function show($id){
        $empresaDatos = empresaDatos::find($id);
        return view('empresa-datos.show', ['empresaDatos' => $empresaDatos]);
    }

    public function edit($id){
        $empresaDatos = empresaDatos::find($id);
        return view('empresa-datos.edit', ['empresaDatos' => $empresaDatos]);
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
            'logo' => 'required',
            'representante' => 'required',

        ]);
        $empresaDatos = new empresaDatos();
        $empresaDatos->nombre = $request->nombre;
        $empresaDatos->telefono = $request->telefono;
        $empresaDatos->direccion = $request->direccion;
        $empresaDatos->correo = $request->correo;
        $empresaDatos->representante = $request->representante;
        $nombre = time()."_".$request->file('logo')->getClientOriginalName();
        $empresaDatos->logo = $nombre;
        Storage::disk('imgExpedientes')->put($nombre, File::get($request->file('logo')));
        $empresaDatos->save();

        return redirect(route('empresa-datos.index'))->with('success', 'Registro ingresado con éxito');

    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
            'representante' => 'required',

        ]);
        $empresaDatos = empresaDatos::find($id);
        $empresaDatos->nombre = $request->nombre;
        $empresaDatos->telefono = $request->telefono;
        $empresaDatos->direccion = $request->direccion;
        $empresaDatos->correo = $request->correo;
        $empresaDatos->representante = $request->representante;
        if (isset($request->logo)) {

            $nombre = time()."_".$request->file('logo')->getClientOriginalName();
            Storage::disk('imgExpedientes')->delete($empresaDatos->logo, File::get($request->file('logo')));
            $empresaDatos->logo = $nombre;
            Storage::disk('imgExpedientes')->put($nombre, File::get($request->file('logo')));

            
        }
        $empresaDatos->save();

        return redirect(route('empresa-datos.index'))->with('success', 'Registro actualizado con éxito');

    }

    public function destroy($id){
        empresaDatos::find($id)->delete();

        return redirect(route('empresa-datos.index'))->with('success', 'Registro eliminado con éxito');


    }

    
}
