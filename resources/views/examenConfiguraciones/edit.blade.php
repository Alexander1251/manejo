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
                                {{ __('Actualizar rol') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('examen-configuraciones.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('examen-configuraciones.update', $examenConfiguracion->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="titulo">Título</label>
                                    <input value="{{$examenConfiguracion->titulo}}" type="text" name="titulo" class="form-control" placeholder="Título" required>
        
                                    {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
                                <div class="mb-3">
        
                                    <label for="total_preguntas">Total de preguntas</label>
                                    <input value="{{$examenConfiguracion->total_preguntas}}" type="number" name="total_preguntas" class="form-control" placeholder="Total preguntas" required>
        
                                    {!! $errors->first('total_preguntas', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
                                <div class="mb-3">
        
                                    <label for="nota_maxima">Nota máxima</label>
                                    <input value="{{$examenConfiguracion->nota_maxima}}" type="number" name="nota_maxima" class="form-control" placeholder="Nota máxima" required>
        
                                    {!! $errors->first('nota_maxima', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
                                <div class="mb-3">
        
                                    <label for="nota_aprobada">Nota aprobada</label>
                                    <input value="{{$examenConfiguracion->nota_aprobada}}" type="number" name="nota_aprobada" class="form-control" placeholder="Nota aprobada" required>
        
                                    {!! $errors->first('nota_aprobada', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
                                <div class="mb-3">
        
                                    <label for="tiempo_examen">Tiempo examen en minutos</label>
                                    <input value="{{$examenConfiguracion->tiempo_examen}}" type="number" name="tiempo_examen" class="form-control" placeholder="Tiempo examen" required>
        
                                    {!! $errors->first('tiempo_examen', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>




                                <div class="mb-3">

                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-select" id="estado"
                                        aria-label="Default select example">


                                        @if ($examenConfiguracion->estado == 'Activo')
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
