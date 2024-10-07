@extends('layouts.app')
<style>

</style>
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('message'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        

                        <div class="text-center">
                            <h5>Presiona el botón para empezar la prueba:</h5>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto">



                            <a class="btn btn-md btn-warning" onclick="confirmacion(event)"
                                href="{{ route('examenes.form') }}">Iniciar Examen</a>


                        </div>

                        <br>
                        @if (Auth::user()->id_rol == 1)
                            
                        
                        <div class="container">
                            <div class="text-center">
                                <form action="{{ route('Buscar') }}" method="POST">
                                    @csrf
                                    <input required type="date" id="fechaInicio" name="fechaInicio" placeholder="Fecha de inicio">
                                    <input required type="date" id="fechaFin" name="fechaFin" placeholder="Fecha de fin">
                                    <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                                </form>
                            </div>
                            <h5>{{$titulo}}</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes teóricos realizados</h5>
                                            <p class="card-text text-center h5" id="examenesT"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesT}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes teóricos aprobados</h5>
                                            <p class="card-text text-center h5" id="examenesTA"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesTA}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes teóricos reprobados</h5>
                                            <p class="card-text text-center h5" id="examenesTR"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesTR}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes prácticos realizados</h5>
                                            <p class="card-text text-center h5"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesP}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes prácticos aprobados</h5>
                                            <p class="card-text text-center h5"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesPA}}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Exámenes prácticos reprobados</h5>
                                            <p class="card-text text-center h5"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$examenesPR}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Total clientes</h5>
                                            <p class="card-text text-center h5"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">{{$clientes}}</span> </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Monto de licencias</h5>
                                            <p class="card-text text-center h5"><span style="border-radius:7px;padding-left: 15px; padding-right:15px; background: #135D66; color: white">$ {{$monto}}</span></p>
                                        </div>
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmacion(e) {
            e.preventDefault();

            var url = e.currentTarget.getAttribute('href');
            Swal.fire({
                title: "¿Estás seguro de iniciar el examen?",
                text: "El examen está compuesto por un total de {{ $configuracion->total_preguntas }} preguntas, tendrás un máximo de {{ $configuracion->tiempo_examen }} minutos para terminar la prueba, la calificación necesaria para aprobar es {{ $configuracion->nota_aprobada }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, empezar la prueba",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
@endsection
