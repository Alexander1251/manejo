<?php

namespace App\Http\Controllers;

use App\Models\pizarra;
use Illuminate\Http\Request;

class pizarraController extends Controller
{
    public function index(){

        $borrador = pizarra::where('id_usuario', auth()->user()->id)->orderBy('id', 'desc')->first();
        return view('pizarra.pizarra', ['borrador' => $borrador]);
    }

    public function store(Request $request){
        
        $pizarra = new pizarra();
        $pizarra->pizarra = $request->input('data');
        $pizarra->id_usuario = auth()->user()->id;
        $pizarra->save();

        return response()->json(['message' => 'Canvas guardado correctamente']);

    }
}
