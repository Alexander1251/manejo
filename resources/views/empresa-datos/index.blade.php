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
                                {{ __('Datos de la empresa') }}
                            </span>




                            <div class="float-right">


                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-placement="left">
                                    {{ __('Crear nuevo registro') }}
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


                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Correo</th>
                                        <th>Logo</th>
                                        <th>Representante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empresasDatos as $empresaDatos)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $empresaDatos->nombre }}</td>
                                            <td>{{ $empresaDatos->telefono }}</td>
                                            <td>{{ $empresaDatos->direccion }}</td>
                                            <td>{{ $empresaDatos->correo }}</td>
                                            <td><img src="{{ asset('imgExpedientes/' . $empresaDatos->logo) }}" width="100px"
                                                height="100px"></td>
                                            <td>{{ $empresaDatos->representante }}</td>

                                            <td>
                                                <form action="{{ route('empresa-datos.destroy', $empresaDatos->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('empresa-datos.show', $empresaDatos->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('empresa-datos.edit', $empresaDatos->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
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
    <form action="{{ route('empresa-datos.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Empresa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf
                        <div class="mb-3">

                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>

                            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>

                            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>

                            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="correo">Correo</label>
                            <input type="email" name="correo" class="form-control" placeholder="Correo" required>

                            {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">
                            <label for="logo">Logo: </label>
                            <input required name="logo" accept="image/*" type="file">
                        </div>

                        <div class="mb-3">

                            <label for="representante">Representante</label>
                            <input type="text" name="representante" class="form-control" placeholder="Representante" required>

                            {!! $errors->first('representante', '<div class="invalid-feedback">:message</div>') !!}

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
    </script>
@endsection
