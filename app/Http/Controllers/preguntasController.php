<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class preguntasController extends Controller
{
    public function index()
    {
        $preguntas = pregunta::all();
        $categorias = categoria::all();
        return view('preguntas.index', ['preguntas' => $preguntas, 'categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required',
            'id_categoria' => 'required',
            'estado' => 'required',
        ]);

        $pregunta = new pregunta();
        $pregunta->pregunta = $request->pregunta;
        $pregunta->id_categoria = $request->id_categoria;
        if (isset($request->imagen)) {
            $nombre = time()."_".$request->file('imagen')->getClientOriginalName();
            $pregunta->imagen = $nombre;
    
            Storage::disk('imgPreguntas')->put($nombre, File::get($request->file('imagen')));
        }
        
       

       
        $pregunta->estado = $request->estado;
        $pregunta->save();

        return redirect(route('preguntas.index'))->with('success', 'Registro ingresado con éxito');
    }

    public function show($id)
    {
        $pregunta = pregunta::find($id);
        return view('preguntas.show', ['pregunta' => $pregunta]);
    }

    public function edit($id)
    {
        $pregunta = pregunta::find($id);
        $categorias = categoria::all();
        return view('preguntas.edit', ['pregunta' => $pregunta, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pregunta' => 'required',
            'id_categoria' => 'required',
            'estado' => 'required',
        ]);

        $pregunta = pregunta::find($id);
        $pregunta->pregunta = $request->pregunta;
        $pregunta->estado = $request->estado;
        $pregunta->id_categoria = $request->id_categoria;
        if (isset($request->imagen)) {
            $nombre = time()."_".$request->file('imagen')->getClientOriginalName();
            Storage::disk('imgPreguntas')->delete($pregunta->imagen, File::get($request->file('imagen')));
            $pregunta->imagen = $nombre;
    
            Storage::disk('imgPreguntas')->put($nombre, File::get($request->file('imagen')));
        }
        $pregunta->save();

        return redirect(route('preguntas.index'))->with('success', 'Registro actualizado con éxito');
    }

    public function destroy($id)
    {
        pregunta::find($id)->delete();
        return redirect(route('preguntas.index'))->with('success', 'Registro eliminado con éxito');
    }
}
