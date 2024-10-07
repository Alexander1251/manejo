<?php

namespace App\Http\Controllers;

use App\Models\detalleIngreso;
use App\Models\empresaDatos;
use App\Models\escuela;
use App\Models\expediente;
use App\Models\ingreso;
use App\Models\licenciaTipo;
use App\Models\tramiteClase;
use App\Models\usuario;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class expedientesController extends Controller
{
    public function index()
    {
        $licencia_tipos = licenciaTipo::all();
        $tramite_clases = tramiteClase::all();
        $usuarios = usuario::all();
        $expedientes = expediente::all();
        $ingresos = ingreso::where('expediente', 'Si')->get();
        $escuelas = escuela::all();

        return view('expedientes.index', ['escuelas' => $escuelas, 'ingresos' => $ingresos, 'licencia_tipos' => $licencia_tipos, 'tramite_clases' => $tramite_clases, 'usuarios' => $usuarios, 'expedientes' => $expedientes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_ingreso' => 'required',
            'id_licencia' => 'required',
            'fecha_examen_visual' => 'required',
            'estado_examen_visual' => 'required',
            'fecha_examen_teorico' => 'required',
            'estado_examen_teorico' => 'required',
            'fecha_examen_practico' => 'required',
            'estado_examen_practico' => 'required',
            'estado' => 'required',
            'imagen' => 'required',
          
            'factura' => 'required|unique:expedientes',
            'id_escuela' => 'required',
            'registro' => 'required'


        ]);

        if (expediente::where('id_cliente', $request->id_cliente)->where('estado', 'Activo')->first() != null) {
            return redirect(route('expedientes.index'))->withErrors('Este usuario ya posee un expediente activo, para crear un nuevo expediente cambie el estado del anterior a inactivo');
        }

        $expediente = new expediente();

        $expediente->id_cliente = $request->id_cliente;
        $expediente->id_ingreso = $request->id_ingreso;
        $expediente->id_licencia_tipo = $request->id_licencia;
        $expediente->fecha_examen_visual = $request->fecha_examen_visual;
        $expediente->estado_examen_visual = $request->estado_examen_visual;
        $expediente->fecha_examen_practico = $request->fecha_examen_practico;
        $expediente->id_escuela = $request->id_escuela;
        $expediente->estado_examen_practico = $request->estado_examen_practico;
        $expediente->fecha_examen_teorico = $request->fecha_examen_teorico;
        $expediente->estado_examen_teorico = $request->estado_examen_teorico;
        $expediente->estado = $request->estado;
        $expediente->factura = $request->factura;
        $expediente->fecha = Carbon::now();
        $clase = ingreso::find($request->id_ingreso);
        $expediente->monto = $clase->precio;
        $nombre = time() . "_" . $request->file('imagen')->getClientOriginalName();
        $expediente->foto = $nombre;
        Storage::disk('imgExpedientes')->put($nombre, File::get($request->file('imagen')));
        $expediente->registro = $request->registro;
       

        $ingreso = new detalleIngreso();
        $ingreso->numero_factura = $request->factura;
        $ingreso->id_ingreso = $request->id_ingreso;
        $ingreso->fecha = Carbon::now();
        $ingreso->cantidad = 1;
        $ingreso->monto = $expediente->monto;
       
        $ingreso->total = $expediente->monto;
        $ingreso->id_procedencia = $request->id_escuela;
        $ingreso->nombres = $expediente->cliente->nombres;
        $ingreso->apellidos = $expediente->cliente->apellidos;
        $ingreso->dui = $expediente->cliente->dui;
      
        if(isset($request->direccion) && $request->direccion != null){
            $ingreso->direccion = $request->direccion;


        }

        if(isset($request->municipio) && $request->municipio != null){
            $ingreso->municipio = $request->municipio;


        }

        if(isset($request->departamento) && $request->departamento != null){
            $ingreso->departamento = $request->departamento;


        }


        if ($expediente->cliente->nit != null) {
            $ingreso->nit = $expediente->cliente->nit;
        }

        if ($expediente->cliente->nrc != null) {
            $ingreso->nrc = $expediente->cliente->nrc;
        }

        if ($expediente->cliente->giro != null) {
            $ingreso->giro = $expediente->cliente->giro;
        }

        $ingreso->save();
        $expediente->save();


        return redirect(route('expedientes.index'))->with('success', 'Registro ingresado con éxito');
    }

    public function show($id)
    {
        $expediente = expediente::find($id);
        return view('expedientes.show', ['expediente' => $expediente]);
    }

    public function edit($id)
    {
        $expediente = expediente::find($id);
        $licencia_tipos = licenciaTipo::all();
        $tramite_clases = tramiteClase::all();
        $usuarios = usuario::all();
        $escuelas = escuela::all();
        $ingresos = ingreso::where('expediente', 'Si')->get();
        return view('expedientes.edit', ['escuelas' => $escuelas, 'ingresos' => $ingresos, 'licencia_tipos' => $licencia_tipos, 'tramite_clases' => $tramite_clases, 'usuarios' => $usuarios, 'expediente' => $expediente]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required',
            'id_ingreso' => 'required',
            'id_licencia' => 'required',
            'fecha_examen_visual' => 'required',
            'estado_examen_visual' => 'required',
            'fecha_examen_teorico' => 'required',
            'estado_examen_teorico' => 'required',
            'fecha_examen_practico' => 'required',
            'estado_examen_practico' => 'required',
            'estado' => 'required',
            
            'factura' => ['required',  Rule::unique('expedientes')->ignore($id)],
            'id_escuela' => 'required',
            'registro' => 'required',



        ]);

        $expediente = expediente::find($id);
        $expediente->id_cliente = $request->id_cliente;
        $expediente->id_ingreso = $request->id_ingreso;
        $expediente->id_licencia_tipo = $request->id_licencia;
        $expediente->fecha_examen_visual = $request->fecha_examen_visual;
        $expediente->estado_examen_visual = $request->estado_examen_visual;
        $expediente->fecha_examen_practico = $request->fecha_examen_practico;
        $expediente->id_escuela = $request->id_escuela;
        $expediente->estado_examen_practico = $request->estado_examen_practico;
        $expediente->fecha_examen_teorico = $request->fecha_examen_teorico;
        $expediente->estado_examen_teorico = $request->estado_examen_teorico;
        if (expediente::where('id_cliente', $request->id_cliente)->where('estado', 'Activo')->first() != null) {
            if ($request->estado == 'Activo' && expediente::where('id_cliente', $request->id_cliente)->where('estado', 'Activo')->first()->id != $expediente->id) {
                return redirect(route('expedientes.index'))->withErrors('Este usuario ya posee un expediente activo, para crear un nuevo expediente cambie el estado del anterior a inactivo');
            }
        }
        $expediente->estado = $request->estado;
        $expediente->fecha = Carbon::now();
        $expediente->registro = $request->registro;


        $expediente->factura = $request->factura;
        $clase = ingreso::find($request->id_ingreso);
        $expediente->monto = $clase->precio;
        if (isset($request->imagen)) {

            $nombre = time() . "_" . $request->file('imagen')->getClientOriginalName();
            Storage::disk('imgExpedientes')->delete($expediente->foto, File::get($request->file('imagen')));
            $expediente->foto = $nombre;
            Storage::disk('imgExpedientes')->put($nombre, File::get($request->file('imagen')));
        }


       

        $ingreso = detalleIngreso::where('numero_factura', $expediente->factura)->first();
        $ingreso->numero_factura = $request->factura;
        $ingreso->id_ingreso = $request->id_ingreso;
        $ingreso->fecha = $expediente->fecha;
        $ingreso->cantidad = 1;
        $ingreso->monto = $expediente->monto;
       
        $ingreso->total = $expediente->monto;
        $ingreso->id_procedencia = $request->id_escuela;
        $ingreso->nombres = $expediente->cliente->nombres;
        $ingreso->apellidos = $expediente->cliente->apellidos;
        $ingreso->dui = $expediente->cliente->dui;
        if(isset($request->direccion) && $request->direccion != null){
            $ingreso->direccion = $request->direccion;


        }

        if(isset($request->municipio) && $request->municipio != null){
            $ingreso->municipio = $request->municipio;


        }

        if(isset($request->departamento) && $request->departamento != null){
            $ingreso->departamento = $request->departamento;


        }


        if ($expediente->cliente->nit != null) {
            $ingreso->nit = $expediente->cliente->nit;
        }

        if ($expediente->cliente->nrc != null) {
            $ingreso->nrc = $expediente->cliente->nrc;
        }

        if ($expediente->cliente->giro != null) {
            $ingreso->giro = $expediente->cliente->giro;
        }
        $ingreso->save();
        $expediente->save();

        return redirect(route('expedientes.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function destroy($id)
    {
        expediente::find($id)->delete();
        return redirect(route('expedientes.index'))->with('success', 'Registro eliminado con éxito');
    }

    public function generarExpedientePdf($id)
    {
        $expediente = expediente::find($id);
        $path = 'imgExpedientes/' . $expediente->foto;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('expedientes.pdf', ['expediente' => $expediente, 'foto' => $base64]);
        $pdf->render();
        return $pdf->stream();
    }


    public function generarFacturaPdf($id)
    {
        $expediente = expediente::find($id);

        $empresaDatos = empresaDatos::all()->first();
        $path = 'imgExpedientes/' . $empresaDatos->logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $pdf->loadView('expedientes.factura', ['expediente' => $expediente, 'foto' => $base64, 'empresaDatos' => $empresaDatos]);
        $pdf->render();
        return $pdf->stream();
    }

    public function crearUsuario(Request $request)
    {

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'dui' => 'required|unique:usuarios|string|size:10',
            'telefono' => 'required|string|size:8',
            'email' => 'required|email|unique:usuarios',
            
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
       
            'usuario' => 'required|unique:usuarios|alpha_dash',
            
         


        ]);

        $usuario = new usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->dui = $request->dui;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;

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
        
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $fecha_nacimiento = new DateTime($request->fecha_nacimiento);
        $usuario->password = Hash::make($fecha_nacimiento->format('d-m-Y'));
        $usuario->id_rol = 2;
        $usuario->usuario = $request->usuario;
        $usuario->sexo = $request->sexo;
        $usuario->estado = 'Activo';
        $usuario->save();

        return redirect(route('usuarios.index'))->with('success', 'Registro ingresado con éxito');
    }

    public function generarCreditoFiscal($id)
    {
        $expediente = expediente::find($id);

        $empresaDatos = empresaDatos::all()->first();
        $path = 'imgExpedientes/' . $empresaDatos->logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $pdf->loadView('expedientes.credito-fiscal', ['expediente' => $expediente, 'foto' => $base64, 'empresaDatos' => $empresaDatos]);
        $pdf->render();
        return $pdf->stream();
    }

    public function imprimirShow($id){
        $expediente = expediente::find($id);
        $path = 'imgExpedientes/' . $expediente->foto;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $pdf->loadView('expedientes.show-pdf', ['expediente' => $expediente, 'foto' => $base64]);
        $pdf->render();
        return $pdf->stream();
    }






    /*
    public function generarFacturaPdf($id){
        $response = Http::get('http://localhost:8113/firma/firmardocumento/status');
      

        $response = Http::post('http://localhost:8113/firma/firmardocumento/', [
            'content-type' => 'application/JSON',
            'nit' => '11111111111114',
            'activo' => true,
            'passwordPri' => '123456',
            'dteJson' => []
        ]);

        return $response;

    }*/
}
