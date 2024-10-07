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
                                {{ __('Actualizar Datos de la Empresa') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('empresa-datos.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('empresa-datos.update', $empresaDatos->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <label for="nombre">Nombre</label>
                                <input value={{$empresaDatos->nombre}} type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    
                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3">

                                <label for="telefono">Teléfono</label>
                                <input value={{$empresaDatos->telefono}} type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
    
                                {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                        
    
                            <div class="mb-3">
    
                                <label for="direccion">Dirección</label>
                                <input value={{$empresaDatos->direccion}} type="text" name="direccion" class="form-control" placeholder="Dirección" required>
    
                                {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="correo">Correo</label>
                                <input value={{$empresaDatos->correo}} type="email" name="correo" class="form-control" placeholder="Correo" required>
    
                                {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
                                <label for="logo">Logo: </label>
                                <input name="logo" accept="image/*" type="file">
                            </div>
    
                            <div class="mb-3">
    
                                <label for="representante">Representante</label>
                                <input value={{$empresaDatos->representante}} type="text" name="representante" class="form-control" placeholder="Representante" required>
    
                                {!! $errors->first('representante', '<div class="invalid-feedback">:message</div>') !!}
    
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
