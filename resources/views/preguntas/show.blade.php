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
                            <a class="btn btn-primary" href="{{ route('preguntas.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Preguntas:</strong>
                            {{ $pregunta->pregunta }}
                        </div>

                        <div class="mb-3">
                            <strong>Categoría:</strong>
                            {{ $pregunta->categoria->categoria }}
                        </div>

                        <div class="mb-3">
                            <strong>Imagen:</strong>
                            <br><br>
                            <div><img src="{{asset("imgPreguntas/".$pregunta->imagen)}}" width="100px" height="100px" alt=""></div>
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $pregunta->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
