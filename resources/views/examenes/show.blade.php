@extends('layouts.app')


@section('content')

<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">
                    Detalle del examen realizado por <b>{{ $examen->expediente->cliente->nombres }} {{ $examen->expediente->cliente->apellidos }}</b>
                </span>

                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('examenes.index') }}"> {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($informacion as $info)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$info['pregunta']->pregunta}}</h5>
                        @if (isset($info['pregunta']->imagen))
                        <div class="text-center">
                        <img class="img-pregunta" src="{{ asset('imgPreguntas/' . $info['pregunta']->imagen) }}"
                                alt="" width="100px" height="100px">
                            </div>
                        @endif
                        
                        <p class="card-text {{ $info['respuesta']->validez == 'Correcta' ? 'text-success' : 'text-danger' }}">
                            {{$info['respuesta']->respuesta}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
    



    


@endsection