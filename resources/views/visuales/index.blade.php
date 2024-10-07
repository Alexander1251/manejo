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
                                        <th>Fecha visual</th>
                                        <th>Estado visual</th>
                                        <th>Foto</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expedientes as $expediente)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $expediente->cliente->nombres }} {{ $expediente->cliente->apellidos }}
                                            </td>

                                            <td>{{ $expediente->fecha_examen_visual }}</td>
                                            <td>{{ $expediente->estado_examen_visual }}</td>

                                            <td><img src="{{ asset('imgExpedientes/' . $expediente->foto) }}" width="100px"
                                                    height="100px"></td>


                                            <td>

                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('visuales.show', $expediente->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('visuales.edit', $expediente->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i></a>


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
