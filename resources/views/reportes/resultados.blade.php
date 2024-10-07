@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalle general de ingresos') }}
                            </span>





                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">

                        <div class="text-center">
                            <h5>Ingrese la fecha de la cuál desea conocer el reporte:</h5>
                            <form action="{{ route('reporte-resultados.buscar') }}" method="POST">
                                @csrf


                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-3 ">
                                            <label for="">Fecha inicio:</label>
                                            <input required class="form-control form-control-sm" type="date"
                                                id="fechaInicio" name="fechaInicio" placeholder="Fecha Inicio">
                                            <br>
                                            <label for="">Fecha final:</label>
                                            <input required class="form-control form-control-sm" type="date"
                                                id="fechaFin" name="fechaFin" placeholder="Fecha Fin">
                                        </div>

                                        <div class="mb-3 ">
                                            <h5>Ingrese un tipo de resultado: </h5>
                                            <select name="estatus" id="" class="form-select form-select-sm">
                                                <option value="Aprobados">Aprobados</option>
                                                <option value="Reprobados">Reprobados</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>


                                <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                            </form>
                        </div>

                        @if (isset($clientes) && $clientes != null)
                            <div>
                                <div class="text-center"><br>
                                    @if ($estatus == 'Aprobados')
                                        <h4>REPORTE GENERAL DE APROBADOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }}
                                            AL
                                            {{ date('d-M-Y', strtotime($fechaFin)) }}</h4>
                                    @else
                                        <h4>REPORTE GENERAL DE REPROBADOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }}
                                            AL
                                            {{ date('d-M-Y', strtotime($fechaFin)) }}</h4>
                                    @endif

                                    <a  class="btn btn-sm btn-success" href="{{route('reporte-excel.resultados',['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin, 'estatus' => $estatus])}}">Excel</a>
                                    


                                </div>

                                <div class="row text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Calificación</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clientes as $cliente)

                                            <tr>
                                                <td>{{$cliente->expediente->cliente->nombres}}</td>
                                                <td>{{$cliente->expediente->cliente->apellidos}}</td>
                                                <td>{{$cliente->calificacion}}</td>
                                                <td>{{$cliente->fecha_examen}}</td>
                                            </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <br>
                            <div>
                                <div class="text-center">
                                    <h5>No se encontraron registros en ese rango de fechas</h5>
                                </div>
                            </div>
                        @endif








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
