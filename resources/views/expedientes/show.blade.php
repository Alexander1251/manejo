@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . ' ' . __('Rol') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('expedientes.index') }}"> {{ __('Regresar') }}</a>
                            <a class="btn btn-danger" target="_blank"
                                href="{{ route('expedientes.show-pdf', $expediente->id) }}"><i
                                    class="fa fa-fw fa-file-pdf"></i></a>
                        </div>





                    </div>

                    <div class="card-body">


                        <div class="mb-3">
                            <strong>Cliente:</strong>
                            {{ $expediente->cliente->nombres }} {{ $expediente->cliente->apellidos }}
                        </div>

                        <div class="mb-3">
                            <strong>Factura:</strong>
                            {{ $expediente->factura }}
                        </div>

                        <div class="mb-3">
                            <strong>Registro:</strong>
                            {{ $expediente->registro }}
                        </div>


                        <div class="mb-3">
                            <strong>Tipo de ingreso:</strong>
                            {{ $expediente->ingreso->ingreso }}
                        </div>

                        <div class="mb-3">
                            <strong>Licencia:</strong>
                            {{ $expediente->licenciaTipo->licencia }}
                        </div>

                        <div class="mb-3">
                            <strong>Escuela:</strong>
                            {{ $expediente->escuela->escuela }}
                        </div>

                        <div class="mb-3">
                            <strong>Fecha examen visual:</strong>
                            {{ $expediente->fecha_examen_visual }}
                        </div>

                        <div class="mb-3">
                            <strong>Estado examen visual:</strong>
                            {{ $expediente->estado_examen_visual }}
                        </div>

                        <div class="mb-3">
                            <strong>Fecha examen teórico:</strong>
                            {{ $expediente->fecha_examen_teorico }}
                        </div>

                        @isset($expediente->examen_teorico)
                            <div class="mb-3">
                                <strong>Calificación examen teórico:</strong>
                                {{ $expediente->examen_teorico->calificacion }}
                            </div>
                        @endisset


                        <div class="mb-3">
                            <strong>Estado examen teórico:</strong>
                            {{ $expediente->estado_examen_teorico }}
                        </div>

                        <div class="mb-3">
                            <strong>Fecha examen práctico:</strong>
                            {{ $expediente->fecha_examen_practico }}
                        </div>

                        @isset($expediente->examen_practico)
                            <div class="mb-3">
                                <strong>Calificación examen práctico:</strong>
                                {{ $expediente->examen_practico->calificacion }}
                            </div>
                        @endisset

                        <div class="mb-3">
                            <strong>Estado examen práctico:</strong>
                            {{ $expediente->estado_examen_practico }}
                        </div>

                        <div class="mb-3">
                            <strong>Imagen:</strong>
                            <br><br>
                            <div><img src="{{ asset('imgExpedientes/' . $expediente->foto) }}" width="100px"
                                    height="100px" alt=""></div>
                        </div>

                        <div class="mb-3">
                            <strong>Monto</strong>
                            {{ $expediente->monto }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
