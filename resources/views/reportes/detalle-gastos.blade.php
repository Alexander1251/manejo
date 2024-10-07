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
                                {{ __('Detalle general de gastos') }}
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
                            <form action="{{ route('detalle-gastos-reporte/buscarDetalleGastos') }}" method="POST">
                                @csrf
                                <input  required type="month" id="fecha" name="fecha" placeholder="Fecha">


                                <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                            </form>
                        </div>

                        @if (isset($diarios))
                            <div>


                                <div class="row">

                                    <div class="text-center"><br>
                                        <h4>DETALLE DE GASTOS PARA EL MES: {{ date('M-Y', strtotime($fecha)) }}</h4>
                                        <a  class="btn btn-sm btn-success" href="{{route('reportes-excel.detalle-gastos', $fecha)}}">Excel</a>

                                    </div>


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>TIPO</th>
                                                    @php
                                                        $totales = [];
                                                        $diasDelMes = cal_days_in_month(
                                                            CAL_GREGORIAN,
                                                            date('m', strtotime($fecha)),
                                                            date('Y', strtotime($fecha)),
                                                        );
                                                        for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                                                            echo '<th>' .
                                                                date(
                                                                    'd/m/Y',
                                                                    strtotime(
                                                                        $fecha .
                                                                            '-' .
                                                                            str_pad($dia, 2, '0', STR_PAD_LEFT),
                                                                    ),
                                                                ) .
                                                                '</th>';
                                                        }
                                                    @endphp

                                                    <th>TOTAL</th>




                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($gastos as $gasto)
                                                    @php

                                                        $suma = 0;

                                                        foreach ($diarios[$gasto->id] as $diario) {
                                                            $suma += $diario['total'];
                                                        }

                                                        if ($suma == 0) {

                                                            continue;
                                                        }

                                                        $totales[$loop->iteration - 1] = $suma;

                                                      
                                                    @endphp
                                                    <tr>

                                                        <th>{{ $gasto->tipo }}</th>
                                                        @foreach ($diarios[$gasto->id] as $diario)
                                                            <td>${{ $diario['total'] }}</td>
                                                        @endforeach
                                                        @php
                                                            echo '<td>$' . $suma . '</td>';
                                                        @endphp

                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>TOTAL</th>
                                                    @php

                                                        $diasDelMes = cal_days_in_month(
                                                            CAL_GREGORIAN,
                                                            date('m', strtotime($fecha)),
                                                            date('Y', strtotime($fecha)),
                                                        );
                                                        for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                                                            $suma = 0;
                                                            foreach ($gastos as $gasto) {
                                                                $suma += $diarios[$gasto->id][$dia]['total'];
                                                            }
                                                            echo '<td> $' . $suma . '</td>';
                                                        }

                                                    @endphp

                                                    <td>
                                                        @php
                                                            $totalG = 0;
                                                            foreach ($totales as $total) {
                                                                $totalG += $total;
                                                            }

                                                            echo '$' . $totalG;
                                                        @endphp

                                                    </td>
                                                </tr>





                                            </tbody>
                                        </table>
                                    </div>

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
