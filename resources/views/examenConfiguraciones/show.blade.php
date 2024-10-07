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
                            <a class="btn btn-primary" href="{{ route('examen-configuraciones.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Título:</strong>
                            {{ $examenConfiguracion->titulo }}
                        </div>

                        <div class="mb-3">
                            <strong>Total de preguntas:</strong>
                            {{ $examenConfiguracion->total_preguntas }}
                        </div>

                        <div class="mb-3">
                            <strong>Nota máxima:</strong>
                            {{ $examenConfiguracion->nota_maxima }}
                        </div>

                        <div class="mb-3">
                            <strong>Nota aprobada:</strong>
                            {{ $examenConfiguracion->nota_aprobada }}
                        </div>

                        <div class="mb-3">
                            <strong>Título:</strong>
                            {{ $examenConfiguracion->tiempo_examen }}
                        </div>

                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $examenConfiguracion->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
