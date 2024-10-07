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
                            <a class="btn btn-primary" href="{{ route('respuestas.index', ['id_pregunta' => $id_pregunta]) }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Respuesta:</strong>
                            {{ $respuesta->respuesta }}
                        </div>

                        <div class="mb-3">
                            <strong>Validez:</strong>
                            {{ $respuesta->validez }}
                        </div>

                        
                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $respuesta->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
