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
                                {{ __('Exámenes prácticos') }}
                            </span>




                            <div class="float-right">



                                <a class="btn btn-primary" href="{{ route('prueba-practica.create') }}">
                                    {{ __('Nuevo examen') }}</a>

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
                                        <th>Examinador</th>
                                        <th>Fecha examen</th>
                                        <th>Calificacion</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examenes as $examen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $examen->expediente->cliente->nombres }}
                                                {{ $examen->expediente->cliente->apellidos }}</td>
                                            <td>{{ $examen->examinador->nombres }} {{ $examen->examinador->apellidos }}</td>
                                            <td>{{ $examen->fecha_examen }}</td>
                                            <td>{{ $examen->calificacion }}</td>
                                            <td>{{ $examen->estado }}</td>
                                            <td>

                                                <form action="{{ route('prueba-practica.destroy', $examen->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('prueba-practica.show', $examen->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>

                                                    <a class="btn btn-sm btn-dark" target="_blank"
                                                        href="{{ route('prueba-practica.detallePDF', $examen->id) }}"><i
                                                            class="fa fa-fw fa-file-pdf"></i></a>

                                                    @csrf
                                                    @method('DELETE')
                                                    @if (auth()->user()->id_rol == '1')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i> </button>
                                                    @endif

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
