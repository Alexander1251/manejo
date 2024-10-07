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
                            <a class="btn btn-primary" href="{{ route('detalle-ingresos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Factura:</strong>
                            {{ $detalle->numero_factura }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Tipo:</strong>
                            {{ $detalle->ingreso->ingreso }}
                        </div>

                        <div class="mb-3">
                            <strong>Nombre:</strong>
                            {{ $detalle->nombres }}
                        </div>
                        <div class="mb-3">
                            <strong>Apellidos:</strong>
                            {{ $detalle->apellidos }}
                        </div>
                        <div class="mb-3">
                            <strong>Dui:</strong>
                            {{ $detalle->dui }}
                        </div>
                        <div class="mb-3">
                            <strong>Nit:</strong>
                            {{ $detalle->nit }}
                        </div>
                        <div class="mb-3">
                            <strong>NRC:</strong>
                            {{ $detalle->nrc }}
                        </div>
                        <div class="mb-3">
                            <strong>Giro:</strong>
                            {{ $detalle->giro }}
                        </div>

                        <div class="mb-3">
                            <strong>Dirección:</strong>
                            {{ $detalle->direccion }}
                        </div>

                        <div class="mb-3">
                            <strong>Municipio:</strong>
                            {{ $detalle->municipio }}
                        </div>

                        <div class="mb-3">
                            <strong>Departamento:</strong>
                            {{ $detalle->departamento }}
                        </div>

                        <div class="mb-3">
                            <strong>Monto:</strong>
                            {{ $detalle->monto }}
                        </div>

                        <div class="mb-3">
                            <strong>Cantidad:</strong>
                            {{ $detalle->cantidad }}
                        </div>

                        <div class="mb-3">
                            <strong>Total:</strong>
                            {{ $detalle->total }}
                        </div>

                        <div class="mb-3">
                            <strong>Procedencia:</strong>
                            {{ $detalle->procedencia->escuela }}
                        </div>

                        <div class="mb-3">
                            <strong>Fecha:</strong>
                            {{ $detalle->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
