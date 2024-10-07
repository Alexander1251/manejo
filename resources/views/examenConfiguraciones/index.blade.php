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
                                {{ __('Examen configuraciones') }}
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


                                        <th>Título</th>
                                        <th>Total preguntas</th>
                                        <th>Nota máxima</th>
                                        <th>Nota aprobada</th>
                                        <th>Tiempo examen</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examenConfiguraciones as $examenConfiguracion)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $examenConfiguracion->titulo }}</td>
                                            <td>{{ $examenConfiguracion->total_preguntas }}</td>
                                            <td>{{ $examenConfiguracion->nota_maxima }}</td>
                                            <td>{{ $examenConfiguracion->nota_aprobada }}</td>
                                            <td>{{ $examenConfiguracion->tiempo_examen }}</td>
                                            <td>{{ $examenConfiguracion->estado}}</td>

                                            <td>
                                                <form action="{{ route('examen-configuraciones.destroy', $examenConfiguracion->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('examen-configuraciones.show', $examenConfiguracion->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('examen-configuraciones.edit', $examenConfiguracion->id) }}"><i
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
    <form action="{{ route('examen-configuraciones.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Formato de Examen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="mb-3">

                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Título" required>

                            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                        <div class="mb-3">

                            <label for="total_preguntas">Total de preguntas</label>
                            <input type="number" name="total_preguntas" class="form-control" placeholder="Total preguntas" required>

                            {!! $errors->first('total_preguntas', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                        <div class="mb-3">

                            <label for="nota_maxima">Nota máxima</label>
                            <input type="number" name="nota_maxima" class="form-control" placeholder="Nota máxima" required>

                            {!! $errors->first('nota_maxima', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                        <div class="mb-3">

                            <label for="nota_aprobada">Nota aprobada</label>
                            <input type="number" name="nota_aprobada" class="form-control" placeholder="Nota aprobada" required>

                            {!! $errors->first('nota_aprobada', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                        <div class="mb-3">

                            <label for="tiempo_examen">Tiempo examen en minutos</label>
                            <input type="number" name="tiempo_examen" class="form-control" placeholder="Tiempo examen" required>

                            {!! $errors->first('tiempo_examen', '<div class="invalid-feedback">:message</div>') !!}

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
