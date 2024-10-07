@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Tipo de licencia') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('licencia-tipos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                       
                        <div class="mb-3">
                            <strong>Tipo de licencia:</strong>
                            {{ $licencia_tipo->licencia }}
                        </div>
                        
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            {{ $licencia_tipo->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
