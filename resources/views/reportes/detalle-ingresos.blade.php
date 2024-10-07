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
                            <form action="{{ route('detalle-ingresos-reporte/buscarDetalleIngresos') }}" method="POST">
                                @csrf


                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-3 ">
                                            <input required class="form-control form-control-sm" type="month"
                                                id="fecha" name="fecha" placeholder="Fecha">
                                        </div>

                                        <div class="mb-3 ">
                                            <h5>Ingrese una escuela: </h5>
                                            <select name="escuela" id="" class="form-select form-select-sm">
                                                @foreach ($escuelas as $escuela)
                                                    <option value="{{ $escuela->id }}">{{ $escuela->escuela }}</option>
                                                @endforeach
                                                <option value="Todas">Todas las escuelas</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>


                                <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                            </form>
                        </div>

                        @if (isset($diarios))
                            <div>


                                <div class="row">

                                    <div class="text-center"><br>
                                        <h4>DETALLE DE INGRESOS PARA EL MES: {{ date('M-Y', strtotime($fecha)) }}</h4>
                                        @if ($escuelaF != null)
                                            <h4>Escuela: {{ $escuelaF->escuela }}</h4>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('reportes-excel.detalle-ingresos', ['fecha' => $fecha, 'escuela' => $escuelaF->id]) }}">Excel</a>
                                        @else
                                            <h4>Escuela: Todas las escuelas</h4>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('reportes-excel.detalle-ingresos', ['fecha' => $fecha, 'escuela' => 'Todas']) }}">Excel</a>
                                        @endif


                                    </div>


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    @php
                                                        $totales = [];
                                                        $totalesC = [];
                                                        $diasDelMes = cal_days_in_month(
                                                            CAL_GREGORIAN,
                                                            date('m', strtotime($fecha)),
                                                            date('Y', strtotime($fecha)),
                                                        );
                                                        for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                                                            echo '<th colspan="2">' .
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

                                                    <th colspan="2">GENERAL</th>




                                                </tr>

                                                <tr>
                                                    <th>INGRESO</th>

                                                    @php

                                                        $diasDelMes = cal_days_in_month(
                                                            CAL_GREGORIAN,
                                                            date('m', strtotime($fecha)),
                                                            date('Y', strtotime($fecha)),
                                                        );
                                                        for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                                                            echo '<th>CANTIDAD</th> <th>TOTAL</th>';
                                                        }
                                                    @endphp

                                                    <th>CANTIDAD</th>
                                                    <th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ingresos as $ingreso)
                                                    @php

                                                        $suma = 0;
                                                        $sumaC = 0;

                                                        foreach ($diarios[$ingreso->id] as $diario) {
                                                            $suma += $diario['total'];
                                                            $sumaC += $diario['cantidad'];
                                                        }

                                                        $totales[$loop->iteration - 1] = $suma;
                                                        $totalesC[$loop->iteration - 1] = $sumaC;

                                                        if ($sumaC == 0) {
                                                            continue;
                                                        }
                                                    @endphp
                                                    <tr>

                                                        <th>{{ $ingreso->ingreso }}</th>
                                                        @foreach ($diarios[$ingreso->id] as $diario)
                                                            <td>{{ $diario['cantidad'] }}</td>
                                                            <td>${{ $diario['total'] }}</td>
                                                        @endforeach
                                                        @php
                                                            echo '<td> ' . $sumaC . '</td>';
                                                            echo '<td> $' . $suma . '</td>';

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
                                                            $sumaC = 0;
                                                            foreach ($ingresos as $ingreso) {
                                                                $suma += $diarios[$ingreso->id][$dia]['total'];
                                                                $sumaC += $diarios[$ingreso->id][$dia]['cantidad'];
                                                            }

                                                            echo '<td> ' . $sumaC . '</td>';
                                                            echo '<td> $' . $suma . '</td>';
                                                        }

                                                    @endphp


                                                    @php
                                                        $totalG = 0;
                                                        foreach ($totales as $total) {
                                                            $totalG += $total;
                                                        }

                                                        $totalG2 = 0;
                                                        foreach ($totalesC as $total) {
                                                            $totalG2 += $total;
                                                        }

                                                        echo '<td> ' . $totalG2 . '</td>';
                                                        echo '<td> $' . $totalG . '</td>';
                                                    @endphp


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
