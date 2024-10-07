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
                                {{ __('Detalle de ingresos') }}
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


                                        <th>Factura</th>
                                        <th>Tipo</th>
                                        <th>Monto</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th>Procedencia</th>
                                        <th>Fecha</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $detalle->numero_factura }}</td>
                                            <td>{{ $detalle->ingreso->ingreso }}</td>
                                            <td>{{ $detalle->monto }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>{{ $detalle->total }}</td>
                                            <td>{{ $detalle->procedencia->escuela }}</td>
                                            <td>{{ $detalle->fecha }}</td>


                                            <td>
                                                <form action="{{ route('detalle-ingresos.destroy', $detalle->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('detalle-ingresos.show', $detalle->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('detalle-ingresos.edit', $detalle->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-secondary" target="_blank"
                                                        href="{{ route('detalle-ingresos.factura', $detalle->id) }}"><i
                                                            class="fa fa-fw fa-receipt"></i></a>


                                                    @if (
                                                        $detalle->nit != null &&
                                                            $detalle->giro != null &&
                                                            $detalle->nrc != null &&
                                                            $detalle->direccion != null &&
                                                            $detalle->departamento != null &&
                                                            $detalle->municipio != null)
                                                        <a class="btn btn-sm btn-warning" target="_blank"
                                                            href="{{ route('detalle-ingresos.credito-fiscal', $detalle->id) }}"><i
                                                                class="fa fa-fw fa-file-invoice-dollar"></i></a>
                                                    @endif
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
    <form action="{{ route('detalle-ingresos.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar detalle de ingreso</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="tipo">No. Factura *</label>
                                    <input type="text" name="numero_factura" class="form-control" placeholder="No. Factura"
                                        required>
        
                                    {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="id_ingreso">Tipo de ingreso *</label>
                                    <select name="id_ingreso" class="form-select" id="id_ingreso"
                                        aria-label="Default select example" required>
                                        <option selected="true" disabled="disabled">Seleccione un tipo de ingreso</option>
                                        @foreach ($ingresos as $ingreso)
                                            <option value="{{ $ingreso->id }}">{{ $ingreso->ingreso }}</option>
                                        @endforeach
                                    </select>
        
                                    {!! $errors->first('id_ingreso', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="nombres">Nombres *</label>
                                    <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
        
                                    {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <label for="apellidos">Apellidos *</label>
                                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
        
                                    {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="dui">Dui *</label>
                                    <input id="dui" maxlength="10" type="text" id="dui" name="dui" class="form-control" placeholder="Dui" required>
        
                                    {!! $errors->first('dui', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="nit">Nit</label>
                                    <input id="nit" maxlength="17" type="text" id="nit" name="nit" class="form-control"
                                        placeholder="Nit ">
        
                                    {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="nrc">NRC</label>
                                    <input type="number" name="nrc" class="form-control"
                                        placeholder="NRC ">
        
                                    {!! $errors->first('nrc', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                
                            </div>

                            <div class="col-md-6">
                               
        
                               
        
                                <div class="mb-3" <label for="giro">Giro</label>
                                    <input type="text" name="giro" class="form-control"
                                        placeholder="Giro ">
        
                                    {!! $errors->first('giro', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="direccion">Dirección</label>
                                    <input type="text" name="direccion" class="form-control" placeholder="Dirección"
                                        >
        
                                    {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="municipio">Municipio</label>
                                    <input type="text" name="municipio" class="form-control" placeholder="Municipio"
                                       >
        
                                    {!! $errors->first('municipio', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3" <label for="departamento">Departamento</label>
                                    <input type="text" name="departamento" class="form-control" placeholder="Departamento"
                                       >
        
                                    {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}
        
                                </div>
        
                                <div class="mb-3">
        
                                    <div class="mb-3">
        
                                        <label for="cantidad">Cantidad *</label>
                                        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad"
                                            required>
        
                                        {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        
                                    </div>
        
                                    <div class="mb-3">
        
                                        <label for="id_procedencia">Procedencia *</label>
                                        <select name="id_procedencia" class="form-select" id="id_procedencia"
                                            aria-label="Default select example" required>
                                            <option selected="true" disabled="disabled">Seleccione una procedencia</option>
                                            @foreach ($escuelas as $escuela)
                                                <option value="{{ $escuela->id }}">{{ $escuela->escuela }}</option>
                                            @endforeach
                                        </select>
        
                                        {!! $errors->first('id_procedencia', '<div class="invalid-feedback">:message</div>') !!}
        
                                    </div>
        
                                    <div class="mb-3">
        
                                        <label for="fecha">Fecha *</label>
                                        <input type="date" name="fecha" class="form-control" placeholder="Fecha" required>
        
                                        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        
                                    </div>
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

        $('#dui').on('keypress', function(event) {

            const valor = $(this).val(); // Obtiene el valor actual del input
            const largo = valor.length; // Obtiene la longitud del valor
            const teclaPresionada = event.key;
            // Inserta un guion después del octavo carácter si es posible
            if (largo == 8) {
                console.log(valor);

                const nuevoValor = valor.slice(0, 8) + '-' + valor.slice(8)
                $(this).val(nuevoValor);


            }



        });

        $('#nit').on('keypress', function(event) {

            const valor = $(this).val(); // Obtiene el valor actual del input
            const largo = valor.length; // Obtiene la longitud del valor
            const teclaPresionada = event.key;
            // Inserta un guion después del octavo carácter si es posible
            if (largo == 4) {
                console.log(valor);


                const nuevoValor = valor.slice(0, 4) + '-' + valor.slice(4)
                $(this).val(nuevoValor);



            } else if (largo == 11) {
                console.log(valor);


                const nuevoValor = valor.slice(0, 12) + '-' + valor.slice(12)
                $(this).val(nuevoValor);



            } else if (largo == 15) {
                console.log(valor);


                const nuevoValor = valor.slice(0, 16) + '-' + valor.slice(16)
                $(this).val(nuevoValor);



            }





        });
    </script>
@endsection
