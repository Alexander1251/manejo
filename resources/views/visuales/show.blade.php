@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Rol') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('visuales.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Cliente:</strong>
                            {{ $expediente->cliente->nombres }}  {{ $expediente->cliente->apellidos }}
                        </div>


                        <div class="mb-3">
                            <strong>Fecha examen visual:</strong>
                            {{ $expediente->fecha_examen_visual }}
                        </div>

                        <div class="mb-3">
                            <strong>Estado examen visual:</strong>
                            {{ $expediente->estado_examen_visual }}
                        </div>

                       

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
