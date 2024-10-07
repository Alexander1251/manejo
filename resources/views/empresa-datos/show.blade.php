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
                            <a class="btn btn-primary" href="{{ route('empresa-datos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Nombre:</strong>
                            {{ $empresaDatos->nombre }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Teléfono</strong>
                            {{ $empresaDatos->telefono }}
                        </div>

                        <div class="mb-3">
                            <strong>Dirección:</strong>
                            {{ $empresaDatos->direccion }}
                        </div>

                        <div class="mb-3">
                            <strong>Correo:</strong>
                            {{ $empresaDatos->correo }}
                        </div>

                        <div class="mb-3">
                            <strong>Logo:</strong>
                            <br><br>
                            <div><img src="{{asset('imgExpedientes/'.$empresaDatos->logo)}}" width="100px" height="100px" alt=""></div>
                        </div>

                        <div class="mb-3">
                            <strong>Representante:</strong>
                            {{ $empresaDatos->representante }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
