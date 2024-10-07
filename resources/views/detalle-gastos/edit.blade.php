@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Usuario
@endsection

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Actualizar detalle de gasto') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('detalle-gastos.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalle-gastos.update', $detalle->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="tipo">No. Factura</label>
                                    <input value="{{ $detalle->numero_factura}}" type="text" name="numero_factura" class="form-control" placeholder="No. Factura" required>
        
                                    {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="id_tipo">Tipo</label>
                                    <select name="id_tipo" class="form-select" id="id_tipo" aria-label="Default select example"
                                        required>
                                        
                                        @foreach ($gastos as $gasto)
                                        @if ($gasto->id == $detalle->id_tipo)
                                        <option selected value="{{ $gasto->id }}">{{ $gasto->tipo }}</option>
                                        @else
                                        <option value="{{ $gasto->id }}">{{ $gasto->tipo }}</option>
                                        @endif
                                           
                                        @endforeach
                                    </select>
        
                                    {!! $errors->first('id_tipo', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="monto">Monto</label>
                                    <input value='{{$detalle->monto}}' type="number" step="0.01" name="monto" class="form-control" placeholder=Monto" required>
        
                                    {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="descripcion">Descripción</label>
                                    <input value='{{$detalle->descripcion}}' type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
        
                                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="fecha">Fecha</label>
                                    <input value="{{$detalle->fecha}}" type="date" name="fecha" class="form-control" placeholder="Fecha" required>
        
                                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>

                                <div class="mb-3">

                                    <label for="iva">Agregar IVA</label>
                                    
                                    <select name="iva" id="iva" class="form-select" aria-label="Default select example" required>
                                        <option value="" selected="true" disabled="disabled">Seleccione si desea agregar iva</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
        
        
                                    </select>
        
                                    {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                    
    
    
                            

                          

                            <div class="box-footer mt20 text-center mb-3">
                                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
