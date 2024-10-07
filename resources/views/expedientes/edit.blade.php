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
                                <a class="btn btn-primary" href="{{ route('expedientes.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('expedientes.update', $expediente->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="id_cliente">Cliente </label>
                                    <select name="id_cliente" class="form-select" id="id_rol"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un cliente</option>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == $expediente->cliente->id)
                                                <option selected value="{{ $usuario->id }}">{{ $usuario->nombres }}
                                                    {{ $usuario->apellidos }}</option>
                                            @else
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombres }}
                                                    {{ $usuario->apellidos }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="factura">No. Factura </label>
                                    <input value='{{$expediente->factura}}' type="text" name="factura" class="form-control" placeholder="No Factura" required>
        
                                    {!! $errors->first('factura', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>

                                <div class="mb-3">

                                    <label for="registro">Registro </label>
                                    <input value='{{$expediente->registro}}' type="text" name="registro" class="form-control" placeholder="Registro" required>
        
                                    {!! $errors->first('registro', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>

                                <div class="mb-3">

                                    <label for="id_ingreso">Tipo de ingreso</label>
                                    <select name="id_ingreso" class="form-select" id="id_ingreso"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un tipo de ingreso</option>
                                        @foreach ($ingresos as $ingreso)
                                            @if ($ingreso->id == $expediente->id_ingreso)
                                                <option selected value="{{ $ingreso->id }}">{{ $ingreso->ingreso }}
                                                </option>
                                            @else
                                                <option value="{{ $ingreso->id }}">{{ $ingreso->ingreso }} </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_ingreso', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_licencia">Tipo de licencia</label>
                                    <select name="id_licencia" class="form-select" id="id_licencia"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un tipo de licencia</option>
                                        @foreach ($licencia_tipos as $licencia)
                                            @if ($licencia->id == $expediente->licenciaTipo->id)
                                                <option selected value="{{ $licencia->id }}">{{ $licencia->licencia }}
                                                </option>
                                            @else
                                                <option value="{{ $licencia->id }}">{{ $licencia->licencia }} </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_licencia', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_escuela">Escuela</label>
                                    <select name="id_escuela" class="form-select" id="id_escuela"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione una escuela</option>
                                        @foreach ($escuelas as $escuela)
                                            @if ($escuela->id == $expediente->id_escuela)
                                                <option selected value="{{ $escuela->id }}">{{ $escuela->escuela }}
                                                </option>
                                            @else
                                                <option value="{{ $escuela->id }}">{{ $escuela->escuela }} </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_escuela', '<div class="invalid-feedback">:message</div>') !!}

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
                                        <option selected ='true' value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Aprobado')
                                        <option  value="Reprobado">Reprobado</option>
                                        <option selected ='true' value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Pendiente')
                                        <option value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option selected  ='true' value="Pendiente">Pendiente</option>
                                        @endif
                                        
                                        
                                       
                                    </select>
                                    {!! $errors->first('estado_examen_visual', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fehca_examen_teorico">Fecha examen teórico</label>
                                    <input value={{$expediente->fecha_examen_teorico}} type="date" name="fecha_examen_teorico" class="form-control"
                                        placeholder="Fecha del examen teórico" required>

                                    {!! $errors->first('fecha_examen_teorico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="estado_examen_teorico">Estado examen teórico</label>
                                    <select name="estado_examen_teorico" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        @if ($expediente->estado_examen_practico == 'Reprobado')
                                        <option selected='true' value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Aprobado')
                                        <option  value="Reprobado">Reprobado</option>
                                        <option selected = 'true' value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Pendiente')
                                        <option value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option selected ='true' value="Pendiente">Pendiente</option>
                                        @endif
                                    </select>
                                    {!! $errors->first('estado_examen_teorico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fehca_examen_practico">Fecha examen práctico</label>
                                    <input value={{$expediente->fecha_examen_practico}} type="date" name="fecha_examen_practico" class="form-control"
                                        placeholder="Fecha del examen práctico" required>

                                    {!! $errors->first('fecha_examen_practico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="estado_examen_practico">Estado examen práctico</label>
                                    <select name="estado_examen_practico" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        @if ($expediente->estado_examen_practico == 'Reprobado')
                                        <option selected='true' value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Aprobado')
                                        <option  value="Reprobado">Reprobado</option>
                                        <option selected='true' value="Aprobado">Aprobado</option>
                                        <option  value="Pendiente">Pendiente</option>
                                        @endif
                                        @if ($expediente->estado_examen_practico == 'Pendiente')
                                        <option value="Reprobado">Reprobado</option>
                                        <option  value="Aprobado">Aprobado</option>
                                        <option selected ='true'  value="Pendiente">Pendiente</option>
                                        @endif
                                        
                                        
                                    </select>
                                    {!! $errors->first('estado_examen_practico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">
                                    <label for="imagen">Foto: </label>
                                    <input name="imagen" accept="image/*" type="file">
                                </div>








                                <div class="mb-3">

                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-select" id="estado"
                                        aria-label="Default select example">


                                        @if ($expediente->estado == 'Activo')
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


@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<script>
    $('#Tabla').DataTable({
        responsive: true,
        autoWidth: true,

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "search": "Buscar:",
        }
    })

    $('#dui').on('keypress', function(event) {

        const valor = $(this).val(); // Obtiene el valor actual del input
        const largo = valor.length; // Obtiene la longitud del valor
        const teclaPresionada = event.key;
        // Inserta un guion después del octavo carácter si es posible
        if (largo == 8) {
            console.log(valor);

            const nuevoValor = valor.slice(0, 8) + '-' + valor.slice(8)
            $(this).val(nuevoValor);


        }



    });

    $('#nit').on('keypress', function(event) {

        const valor = $(this).val(); // Obtiene el valor actual del input
        const largo = valor.length; // Obtiene la longitud del valor
        const teclaPresionada = event.key;
        // Inserta un guion después del octavo carácter si es posible
        if (largo == 4) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 4) + '-' + valor.slice(4) 
            $(this).val(nuevoValor);



        }
        else if (largo == 11) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 12) + '-' + valor.slice(12) 
            $(this).val(nuevoValor);



        }
        else if (largo == 15) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 16) + '-' + valor.slice(16) 
            $(this).val(nuevoValor);



        }

       



    });
</script>
@endsection