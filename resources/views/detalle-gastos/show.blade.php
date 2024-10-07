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
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Factura:</strong>
                            {{ $detalle->numero_factura }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Tipo:</strong>
                            {{ $detalle->gasto->tipo }}
                        </div>

                        <div class="mb-3">
                            <strong>Monto:</strong>
                            {{ $detalle->monto }}
                        </div>

                        <div class="mb-3">
                            <strong>IVA:</strong>
                            {{ $detalle->iva }}
                        </div>

                        <div class="mb-3">
                            <strong>Total:</strong>
                            {{ $detalle->total }}
                        </div>

                        <div class="mb-3">
                            <strong>Descripción:</strong>
                            {{ $detalle->descripcion }}
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
