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
                            <a class="btn btn-primary" href="{{ route('ingresos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Ingreso:</strong>
                            {{ $ingreso->ingreso }}
                        </div>

                        <div class="mb-3">
                            <strong>Precio:</strong>
                            ${{ $ingreso->precio }}
                        </div>

                        <div class="mb-3">
                            <strong>Necesita expediente:</strong>
                            {{ $ingreso->expediente }}
                        </div>
                        
                        
                        
                        

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
