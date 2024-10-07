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
                        <a class="btn btn-primary" href="{{ route('prueba-practica.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach ($detalles as $detalle)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title">{{ $detalle->pregunta->pregunta }}</h6>

                            <p class="card-text">
                                {{ $detalle->resultado }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
