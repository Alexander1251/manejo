@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Expedientes') }}
                            </span>




                            <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalDos" data-placement="left">
                                    {{ __('Crear usuario') }}
                                </button>


                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-placement="left">
                                    {{ __('Crear expediente') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id='Tabla' style="width:100%" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>


                                        <th>Cliente</th>
                                        <th>No. Factura</th>
                                        <th>Registro</th>
                                        <th>Trámite</th>
                                        <th>Licencia (tipo)</th>
                                        <th>Escuela</th>

                                        <th>Estado visual</th>

                                        <th>Estado teórico</th>


                                        <th>Estado práctico</th>
                                        <th>Foto</th>


                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expedientes as $expediente)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $expediente->cliente->nombres }} {{ $expediente->cliente->apellidos }}
                                            </td>
                                            <td>{{ $expediente->factura }}</td>
                                            <td>{{ $expediente->registro }}</td>
                                            <td>{{ $expediente->ingreso->ingreso }}</td>
                                            <td>{{ $expediente->licenciaTipo->licencia }}</td>
                                            <td>{{ $expediente->escuela->escuela }}</td>

                                            <td>{{ $expediente->estado_examen_visual }}</td>

                                            <td>{{ $expediente->estado_examen_teorico }}</td>

                                            <td>{{ $expediente->estado_examen_practico }}</td>
                                            <td><img src="{{ asset('imgExpedientes/' . $expediente->foto) }}"
                                                    width="100px" height="100px"></td>
                                            <td>$ {{ $expediente->monto }}</td>
                                            <td>{{ $expediente->estado }}</td>

                                            <td>
                                                <form action="{{ route('expedientes.destroy', $expediente->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('expedientes.show', $expediente->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('expedientes.edit', $expediente->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-secondary" target="_blank"
                                                        href="{{ route('expedientes.factura', $expediente->id) }}"><i
                                                            class="fa fa-fw fa-receipt"></i></a>
                                                    <a class="btn btn-sm btn-dark" target="_blank"
                                                        href="{{ route('expedientes.pdf', $expediente->id) }}"><i
                                                            class="fa fa-fw fa-file-pdf"></i></a>

                                                    @if (
                                                        $expediente->cliente->nit != null &&
                                                            $expediente->cliente->giro != null &&
                                                            $expediente->cliente->nrc != null &&
                                                            $expediente->direccion != null &&
                                                            $expediente->departamento != null &&
                                                            $expediente->municipio != null)
                                                        <a class="btn btn-sm btn-warning" target="_blank"
                                                            href="{{ route('expedientes.credito-fiscal', $expediente->id) }}"><i
                                                                class="fa fa-fw fa-file-invoice-dollar"></i></a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="{{ route('expediente-usuarios.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModalDos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="nombres">Nombres *</label>
                                    <input type="text" name="nombres" class="form-control" placeholder="Nombres"
                                        required>

                                    {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="apellidos">Apellidos *</label>
                                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                                        required>

                                    {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        placeholder="Fecha de nacimiento" required>

                                    {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="dui">Dui *</label>
                                    <input maxlength="10" type="text" id="dui" name="dui"
                                        class="form-control" placeholder="Dui" required>

                                    {!! $errors->first('dui', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="minoridad">Minoridad </label>
                                    <input id="minoridad" type="text"  name="minoridad"
                                        class="form-control" placeholder="Minoridad">

                                    {!! $errors->first('minoridad', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="pasaporte">Pasaporte </label>
                                    <input id="pasaporte" type="text"  name="Pasaporte"
                                        class="form-control" placeholder="Pasaporte">

                                    {!! $errors->first('pasaporte', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="nit">Nit</label>
                                    <input maxlength="17" type="text" id='nit' name="nit"
                                        class="form-control" placeholder="Nit ">

                                    {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                                

                                <div class="mb-3"> <label for="nrc">NRC</label>
                                    <input type="text" name="nrc" class="form-control" placeholder="NRC ">

                                    {!! $errors->first('nrc', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="giro">Giro</label>
                                    <input type="number" name="giro" class="form-control" placeholder="Giro">

                                    {!! $errors->first('giro', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="direccion">Dirección</label>
                                    <input type="text" name="direccion" class="form-control" placeholder="Dirección">

                                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}

                                </div>


                            </div>
                            <div class="col-md-6">


                                <div class="mb-3"> <label for="municipio">Municipio</label>
                                    <input type="text" name="municipio" class="form-control" placeholder="Municipio">

                                    {!! $errors->first('municipio', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3"> <label for="departamento">Departamento</label>
                                    <input type="text" name="departamento" class="form-control"
                                        placeholder="Departamento">

                                    {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="sexo">Sexo *</label>
                                    <select name="sexo" class="form-select" id="sexo"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un sexo</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                    {!! $errors->first('sexo', '<div class="invalid-feedback">:message</div>') !!}

                                </div>








                                <div class="mb-3">

                                    <label for="telefono">Telefono *</label>
                                    <input type="number" name="telefono" class="form-control" placeholder="Telefono"
                                        required>

                                    {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="usuario">Usuario *</label>
                                    <input type="text" name="usuario" class="form-control" placeholder="Usuario"
                                        required>

                                    {!! $errors->first('usuario', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="email">Correo</label>
                                    <input type="email" name="email" class="form-control" placeholder="Correo"
                                        required>

                                    {!! $errors->first('emaill', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                            </div>
                        </div>













                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <form action="{{ route('expedientes.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Expediente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="id_cliente">Cliente</label>
                                    <select name="id_cliente" class="form-select" id="buscador"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un cliente</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">{{ $usuario->nombres }}
                                                {{ $usuario->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="factura">No. Factura</label>
                                    <input type="text" name="factura" class="form-control" placeholder="No Factura"
                                        required>

                                    {!! $errors->first('factura', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="registro">Registro</label>
                                    <input type="text" name="registro" class="form-control" placeholder="Registro"
                                        required>

                                    {!! $errors->first('registro', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_ingreso">Tipo de ingreso</label>
                                    <select name="id_ingreso" class="form-select" id="id_ingreso"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un tipo de ingreso</option>
                                        @foreach ($ingresos as $ingreso)
                                            <option value="{{ $ingreso->id }}">{{ $ingreso->ingreso }} </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_ingreso', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="id_licencia">Tipo de licencia</label>
                                    <select name="id_licencia" class="form-select" id="id_licencia"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un tipo de licencia
                                        </option>
                                        @foreach ($licencia_tipos as $licencia)
                                            <option value="{{ $licencia->id }}">{{ $licencia->licencia }} </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('id_licencia', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                    {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                
                                <div class="mb-3">
                                    <label for="imagen">Foto: </label>
                                    <input required name="imagen" accept="image/*" type="file">
                                </div>

                                
                            </div>
                            <div class="col-md-6">


                                <div class="mb-3">

                                    <label for="fehca_examen_visual">Fecha examen visual</label>
                                    <input type="date" name="fecha_examen_visual" class="form-control"
                                        placeholder="Fecha del examen visual" required>

                                    {!! $errors->first('fecha_examen_visual', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                                <div class="mb-3">

                                    <label for="estado_examen_visual">Estado examen visual</label>
                                    <select name="estado_examen_visual" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        <option value="Reprobado">Reprobado</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
                                    {!! $errors->first('estado_examen_visual', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fehca_examen_teorico">Fecha examen teórico</label>
                                    <input type="date" name="fecha_examen_teorico" class="form-control"
                                        placeholder="Fecha del examen teórico" required>

                                    {!! $errors->first('fecha_examen_teorico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="estado_examen_teorico">Estado examen teórico</label>
                                    <select name="estado_examen_teorico" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        <option value="Reprobado">Reprobado</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
                                    {!! $errors->first('estado_examen_teorico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="fehca_examen_practico">Fecha examen práctico</label>
                                    <input type="date" name="fecha_examen_practico" class="form-control"
                                        placeholder="Fecha del examen práctico" required>

                                    {!! $errors->first('fecha_examen_practico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>

                                <div class="mb-3">

                                    <label for="estado_examen_practico">Estado examen práctico</label>
                                    <select name="estado_examen_practico" class="form-select" id="estado"
                                        aria-label="Default select example">
                                        <option selected="true" disabled="disabled">Seleccione un estado</option>
                                        <option value="Reprobado">Reprobado</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
                                    {!! $errors->first('estado_examen_practico', '<div class="invalid-feedback">:message</div>') !!}

                                </div>







                                

                            </div>






                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                        </div>

                    </div>
                </div>
            </div>
    </form>



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
