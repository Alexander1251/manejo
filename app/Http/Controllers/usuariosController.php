<?php

namespace App\Http\Controllers;

use App\Models\rol;
use App\Models\usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class usuariosController extends Controller
{
    public function index()
    {
        $usuarios = usuario::all();
        $roles = rol::all();

        return view('usuarios.index', ['usuarios' => $usuarios, 'roles' => $roles]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
          
            'telefono' => 'required|string|size:8',
          
            'password' => 'required',
            'sexo' => 'required',
            'id_rol' => 'required',
            'usuario' => 'required|unique:usuarios|alpha_dash',
            'estado' => 'required',
            'fecha_nacimiento' => 'required',
         
            


        ]);

        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->dui = $request->dui;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        if(isset($request->minoridad) && $request->minoridad != null){
            $usuario->minoridad = $request->minoridad;
        }

        if(isset($request->pasaporte) && $request->pasaporte != null){

            $usuario->pasaporte = $request->pasaporte;

        }

        if(isset($request->nit) && $request->nit != null){
            $usuario->nit = $request->nit;


        }

        if(isset($request->nrc) && $request->nrc != null){
            $usuario->nrc = $request->nrc;


        }

        if(isset($request->giro) && $request->giro != null){
            $usuario->giro = $request->giro;


        }
        if(isset($request->direccion) && $request->direccion != null){
            $usuario->direccion = $request->direccion;


        }

        if(isset($request->municipio) && $request->municipio != null){
            $usuario->municipio = $request->municipio;


        }

        if(isset($request->departamento) && $request->departamento != null){
            $usuario->departamento = $request->departamento;


        }
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        if($request->id_rol == 2){
            $fecha_nacimiento = new DateTime($request->fecha_nacimiento);
            $usuario->password = Hash::make($fecha_nacimiento->format('d-m-Y'));

        }
        else{
            $usuario->password = Hash::make($request->password);
        }
        $usuario->id_rol = $request->id_rol;
        $usuario->usuario = $request->usuario;
        $usuario->sexo = $request->sexo;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect(route('usuarios.index'))->with('success', 'Registro ingresado con éxito');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
    
            'telefono' => 'required|string|size:8',
          
            'sexo' => 'required',
            'id_rol' => 'required',
            'usuario' => ['required','alpha_dash',Rule::unique('usuarios')->ignore($id)],
            'estado' => 'required',
            'fecha_nacimiento' => 'required',
           
            


        ]);

        $usuario = usuario::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->dui = $request->dui;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        if (!is_null($request->password)) {
            $usuario->password = Hash::make($request->password);
        }
        if (!is_null($request->password)) {
            $usuario->password = Hash::make($request->password);
        }

        if(isset($request->nit) && $request->nit != null){
            $usuario->nit = $request->nit;


        }

        if(isset($request->nrc) && $request->nrc != null){
            $usuario->nrc = $request->nrc;


        }

        if(isset($request->minoridad) && $request->minoridad != null){

            $usuario->minoridad = $request->minoridad;

        }

        if(isset($request->pasaporte) && $request->pasaporte != null){

            $usuario->pasaporte = $request->pasaporte;

        }

        if(isset($request->giro) && $request->giro != null){
            $usuario->giro = $request->giro;


        }

        if(isset($request->direccion) && $request->direccion != null){
            $usuario->direccion = $request->direccion;


        }

        if(isset($request->municipio) && $request->municipio != null){
            $usuario->municipio = $request->municipio;


        }

        if(isset($request->departamento) && $request->departamento != null){
            $usuario->departamento = $request->departamento;


        }
       

     
        $usuario->id_rol = $request->id_rol;
        $usuario->usuario = $request->usuario;
        $usuario->sexo = $request->sexo;
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect(route('usuarios.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function edit($id)
    {
        $usuario = usuario::find($id);
        $roles = rol::all();

        return view('usuarios.edit', ['usuario' => $usuario, 'roles' => $roles]);
    }

    public function show($id)
    {
        $usuario = usuario::find($id);
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    public function destroy($id)
    {
        usuario::find($id)->delete();
        return redirect(route('usuarios.index'))->with('success', 'Registro eliminado con éxito');
    }
}
