@extends('layouts.app')


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
                            <form action="{{ route('reporte-diario/buscar') }}" method="POST">
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
                                    <h4>REPORTE OPERATIVO DIARIO</h4>
                                    <h4>Utilidad desde la fecha {{ date('d-M-Y', strtotime($fechaInicio)) }} al
                                        {{ date('d-M-Y', strtotime($fechaFin)) }} : ${{ $totalI - $totalG }}</h4>
                                    
                                    <a  class="btn btn-sm btn-success" href="{{route('reporte-diario.reporteExcel',['fecha_inicio' => $fechaInicio, 'fecha_fin' => $fechaFin])}}">Excel</a>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ingresos p-3 mb-3">
                                            <h3>Ingresos</h3>
                                            <h4>Total: ${{ $totalI }}</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>TIPO</th>
                                                        <th>CANTIDAD</th>

                                                        <th>TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  

                                                    @foreach ($ingresos as $ingreso)
                                                        <tr>
                                                            <td>{{ $ingreso->ingreso->ingreso }}</td>
                                                            <td>{{ $ingreso->cantidad}}</td>
                                                            <td>${{ $ingreso->total }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gastos p-3 mb-3">
                                            <h3>Gastos</h3>
                                            <h4>Total: ${{ $totalG }} </h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>TIPO</th>

                                                        <th>TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($detalles as $detalle)
                                                        <tr>
                                                            <td>{{ $detalle->gasto->tipo }}</td>
                                                            <td>${{ $detalle->total }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <!-- Aquí van las filas de gastos -->
                                                </tbody>
                                            </table>
                                        </div>
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
