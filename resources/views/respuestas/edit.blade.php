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
                                {{ __('Actualizar respuesta') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('respuestas.index', ['id_pregunta' => $id_pregunta]) }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('respuestas.update', ['id_pregunta'=> $id_pregunta, 'id' => $respuesta->id]) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="respuesta">Respuesta:</label>
                                    <input value="{{$respuesta->respuesta}}" type="text" name="respuesta" class="form-control" placeholder="Respuesta" required>
        
                                    {!! $errors->first('respuesta', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">

                                    <label for="validez">Validez</label>
                                    <select name="validez" class="form-select" id="validez"
                                        aria-label="Default select example">
    
    
                                        @if ($respuesta->validez == 'Correcta')
                                            <option value="Correcta" selected>Correcta</option>
                                            <option value="Incorrecta">Incorrecta</option>
                                        @else
                                        <option value="Correcta">Correcta</option>
                                        <option value="Incorrecta" selected>Incorrecta</option>
                                        @endif
    
                                    </select>
    
                                    {!! $errors->first('validez', '<div class="invalid-feedback">:message</div>') !!}
    
                                </div>
        
                    
    
    
                            <div class="mb-3">

                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select" id="estado"
                                    aria-label="Default select example">


                                    @if ($respuesta->estado == 'Activo')
                                        <option value="Activo" selected>Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    @else
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo" selected>Inactivo</option>
                                    @endif

                                </select>

                                {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}

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
