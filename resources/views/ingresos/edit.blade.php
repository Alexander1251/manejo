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
                                {{ __('Actualizar ingreso') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('ingresos.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ingresos.update', $ingreso->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="ingreso">ingreso</label>
                                    <input value='{{$ingreso->ingreso}}' type="text" name="ingreso" class="form-control" placeholder="Ingreso" required>
        
                                    {!! $errors->first('ingreso', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>

                                <div class="mb-3">

                                    <label for="precio">Precio</label>
                                    <input value='{{$ingreso->precio}}' type="text" name="precio" class="form-control" placeholder="Precio" required>
        
                                    {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>

                                <div class="mb-3">

                                    <label for="expediente">Necesita expediente</label>
                                    
                                    <select name="expediente" id="expediente" class="form-select" aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione si el ingreso necesita expediente</option>
                                        @if ($ingreso->expediente == 'Si')
                                        <option selected value="Si">Si</option>
                                        <option value="No">No</option>

                                        
                                            
                                        @else
                                        <option value="Si">Si</option>
                                        <option selected value="No">No</option>
                                       
                                            
                                        @endif
        
        
                                    </select>
        
                                    {!! $errors->first('expediente', '<div class="invalid-feedback">:message</div>') !!}
        
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
