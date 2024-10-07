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
                                {{ __('Actualizar pregunta') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('preguntas.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('preguntas.update', $pregunta->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="pregunta">Pregunta:</label>
                                    <input value="{{$pregunta->pregunta}}" type="text" name="pregunta" class="form-control" placeholder="pregunta" required>
        
                                    {!! $errors->first('pregunta', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="id_categoria">Categoría:</label>
                                    <select name="id_categoria" class="form-select" id="id_categoria"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione una categoría</option>
                                        @foreach ($categorias as $categoria)
                                        @if ($categoria->id == $pregunta->categoria->id)
                                        <option value="{{ $categoria->id }}" selected>{{ $categoria->categoria }}</option>
                                            
                                        @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                            
                                        @endif
                                            
                                        @endforeach
                                    </select>
        
                                    {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
                                    <label for="imagen">Imagen: </label>
                                    <input required name="imagen" accept="image/*" type="file">
                                </div>
        
                    
    
    
                            <div class="mb-3">

                                <label for="estado">Estado</label>
                                <select name="estado" class="form-select" id="estado"
                                    aria-label="Default select example">


                                    @if ($pregunta->estado == 'Activo')
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
