@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Flujo de efectivo') }}
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
                            <form action="{{ route('flujo-efectivo/buscar') }}" method="POST">
                                @csrf
                                <input required type="month" id="fecha" name="fecha" placeholder="Fecha">


                                <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                            </form>
                        </div>

                        @isset($diarios)
                            
                        

                        <div>
                            <div class="text-center"><br>
                                <h4>FLUJO DE EFECTIVO PARA EL MES: {{date('M-Y', strtotime($fecha))}}</h4>
                                <a  class="btn btn-sm btn-success" href="{{route('reportes-excel.flujo-efectivo', $fecha)}}">Excel</a>
                          
                            </div>


                      
                        <div class="row">
                            <div class="col">
                                <div class="ingresos ">
                                  
                                    <h4>Saldo inicial: ${{$saldoInicial}}</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>FECHA</th>
                                                <th>INGRESOS</th>
                                                <th>GASTOS</th>

                                                <th>SALDO A LA FECHA</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($diarios as $diario)
                                                <tr>
                                                    <td>{{ date('d-M-Y', strtotime($diario['fecha']))}}</td>
                                                    <td>${{number_format($diario['sumaI'],2)}}</td>
                                                    <td>${{number_format($diario['sumaG'],2)}}</td>
                                                    <td>${{number_format($diario['acumulado'],2)}}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th></th>
                                                <th>${{$totalI}}</th>
                                                <th>${{$totalG}}</th>
                                                <th>${{$saldoInicial + $totalI - $totalG}}</th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                    </div>

                    @endisset



                </div>
            </div>

        </div>
    </div>
</div>
@endsection
