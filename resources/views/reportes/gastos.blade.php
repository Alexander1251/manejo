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
                                {{ __('Reporte Operativo') }}
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
                            <h4>Ingrese la fecha de la cuál desea conocer el reporte:</h4>
                            <form action="{{ route('reporte-gastos/buscarGastos') }}" method="POST">
                                @csrf
                                <input required type="date" id="fechaInicio" name="fechaInicio"
                                    placeholder="Fecha de inicio">
                                <input required type="date" id="fechaFin" name="fechaFin" placeholder="Fecha de fin">

                                <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                            </form>
                        </div>

                        @if (isset($detalles))
                            <div>
                                <div class="text-center"><br>
                                    <h4>REPORTE GENERAL DE GASTOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }} AL
                                        {{ date('d-M-Y', strtotime($fechaFin)) }}</h4>
                                        <a  class="btn btn-sm btn-success" href="{{route('reportes-excel.gastos',['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin])}}">Excel</a>
                                    
                                </div>

                                <div class="row">

                                    
                                   
                                    <table class="table" id="Tabla">
                                        <thead>
                                            <tr>
                                                <th>FECHA</th>
                                                <th>DIA</th>
                                                <th>MES</th>
                                                <th>FACTURA</th>
                                                <th>TIPO</th>
                                                <th>MONTO SIN IVA</th>
                                                <th>IVA</th>
                                                <th>Descripción</th>
                                               

                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detalles as $detalle)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->format('d/m/Y') }}</td>
                                                    <td> {{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->isoFormat('dddd ')}}</td>
                                                    <td> {{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->isoFormat('MMMM ')}}</td>
                                                    <td>{{$detalle->numero_factura}}</td>
                                                    <td>{{ $detalle->gasto->tipo }}</td>
                                                    <td>${{$detalle->monto}}</td>
                                                    <td>${{$detalle->iva}}</td>
                                                    
                                                    <td>{{$detalle->descripcion}}</td>
                                                    <td>${{ $detalle->total }}</td>
                                                </tr>
                                            @endforeach
                                            <!-- Aquí van las filas de gastos -->
                                        </tbody>
                                    </table>

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