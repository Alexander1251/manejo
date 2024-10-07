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
                                {{ __('Actualizar examen visual') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('visuales.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('visuales.update', $expediente->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="id_cliente">Cliente</label>
                                    <input type="text" class="form-control" value="{{$expediente->cliente->nombres}} {{$expediente->cliente->apellidos}}" disabled>
                                   

                                  

                                </div>

                               

                              

                                <div class="mb-3">

                                    <label for="fehca_examen_visual">Fecha examen visual</label>
                                    <input value={{$expediente->fecha_examen_visual}} type="date" name="fecha_examen_visual" class="form-control"
                                        placeholder="Fecha del examen visual" required>

                                    {!! $errors->first('fecha_examen_visual', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                                <div class="mb-3">

                                    <label for="estado_examen_visual">Estado examen visual</label>
                                    <select name="estado_examen_visual" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        @if ($expediente->estado_examen_practico == 'Reprobado')
                                        <option selected value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Aprobado')
                                        <option  value="Reprobado">Reprobado</option>
                                        <option selected value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Pendiente')
                                        <option value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option selected  value="Pendiente">Pendiente</option>
                                        @endif
                                        
                                        
                                       
                                    </select>
                                    {!! $errors->first('estado_examen_visual', '<div class="invalid-feedback">:message</div>') !!}

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
