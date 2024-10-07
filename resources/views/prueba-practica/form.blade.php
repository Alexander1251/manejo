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
                                {{ __('Prueba práctica') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prueba-practica.store') }}" role="form"
                            enctype="multipart/form-data">

                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" class="form-select" id="id_rol"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombres }}
                                                {{ $cliente->apellidos }}</option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                            </div>
                    </div>

                    @foreach ($categorias as $categoria)
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ $categoria->categoria }}
                            </span>


                        </div>
                    </div>
                    <div class="card-body">

                    @foreach ($preguntas as $pregunta)
                    @if ($pregunta->id_categoria == $categoria->id)
                        
                    <div class="form-row">
                        <div class="col">
                            <label for="pregunta">{{$pregunta->pregunta}} </label>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input checked class="form-check-input" type="radio" name="pregunta{{$pregunta->id}}" value="Si">
                                <label class="form-check-label">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pregunta{{$pregunta->id}}" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endif
                        
                    @endforeach


                    </div>

                   



                    @endforeach


                    










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
