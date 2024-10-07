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
                                {{ __('Actualizar detalle de ingreso') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('detalle-ingresos.index') }}">
                                    {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalle-ingresos.update', $detalle->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">

                                    <label for="ingreso">No. Factura *</label>
                                    <input value="{{ $detalle->numero_factura }}" type="text" name="numero_factura"
                                        class="form-control" placeholder="No. Factura" required>

                                    {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_ingreso">Tipo de ingreso *</label>
                                    <select name="id_ingreso" class="form-select" id="id_ingreso"
                                        aria-label="Default select example" required>

                                        @foreach ($ingresos as $ingreso)
                                            @if ($ingreso->id == $detalle->id_ingreso)
                                                <option selected value="{{ $ingreso->id }}">{{ $ingreso->ingreso }}
                                                </option>
                                            @else
                                                <option value="{{ $ingreso->id }}">{{ $ingreso->ingreso }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_ingreso', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="nombres">Nombres *</label>
                                    <input value="{{ $detalle->nombres }}" type="text" name="nombres"
                                        class="form-control" placeholder="Nombres" required>

                                    {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="apellidos">Apellidos *</label>
                                    <input value="{{ $detalle->apellidos }}" type="text" name="apellidos"
                                        class="form-control" placeholder="Apellidos" required>

                                    {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="dui">Dui *</label>
                                    <input id="dui" maxlength="10" value="{{ $detalle->dui }}" type="text"  name="dui"
                                        class="form-control" placeholder="Dui" required>

                                    {!! $errors->first('dui', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="nit">Nit</label>
                                    <input id="nit" maxlength="17" value="{{ $detalle->nit }}" type="text"  name="nit"
                                        class="form-control"
                                        placeholder="Nit">

                                    {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="nrc">NRC</label>
                                    <input value="{{ $detalle->nrc }}" type="number" name="nrc" class="form-control"
                                        placeholder="NRC ">

                                    {!! $errors->first('nrc', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="giro">Giro</label>
                                    <input value="{{ $detalle->giro }}" type="text" name="giro" class="form-control"
                                        placeholder="Giro ">

                                    {!! $errors->first('giro', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="direccion">Dirección</label>
                                    <input value="{{ $detalle->direccion }}" type="text" name="direccion"
                                        class="form-control" placeholder="Dirección">

                                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="municipio">Municipio</label>
                                    <input value="{{ $detalle->municipio }}" type="text" name="municipio"
                                        class="form-control" placeholder="Municipio">

                                    {!! $errors->first('municipio', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3" <label for="departamento">Departamento</label>
                                    <input value="{{ $detalle->departamento }}" type="text" name="departamento"
                                        class="form-control" placeholder="Departamento">

                                    {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="cantidad">Cantidad *</label>
                                    <input @if ($detalle->ingreso->expediente == 'Si')  @endif value='{{ $detalle->cantidad }}'
                                        type="number" step="0.01" name="cantidad" class="form-control"
                                        placeholder=cantidad" required>

                                    {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_procedencia">Procedencia *</label>
                                    <select name="id_procedencia" class="form-select" id="id_procedencia"
                                        aria-label="Default select example" required>

                                        @foreach ($escuelas as $escuela)
                                            @if ($escuela->id == $detalle->id_procedencia)
                                                <option selected value="{{ $escuela->id }}">{{ $escuela->escuela }}
                                                </option>
                                            @else
                                                <option value="{{ $escuela->id }}">{{ $escuela->escuela }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_procedencia', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fecha">Fecha *</label>
                                    <input value="{{ $detalle->fecha }}" type="date" name="fecha"
                                        class="form-control" placeholder="Fecha" required>

                                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}

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



            } else if (largo == 11) {
                console.log(valor);


                const nuevoValor = valor.slice(0, 12) + '-' + valor.slice(12)
                $(this).val(nuevoValor);



            } else if (largo == 15) {
                console.log(valor);


                const nuevoValor = valor.slice(0, 16) + '-' + valor.slice(16)
                $(this).val(nuevoValor);



            }





        });
    </script>
@endsection
