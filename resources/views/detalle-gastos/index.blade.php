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
                                {{ __('Detalle de gastos') }}
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
                                        <th>IVA</th>
                                        <th>Total</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $detalle->numero_factura }}</td>
                                            <td>{{ $detalle->gasto->tipo }}</td>
                                            <td>{{ $detalle->monto }}</td>
                                            <td>{{ $detalle->iva }}</td>
                                            <td>{{ $detalle->total }}</td>
                                            <td>{{ $detalle->descripcion }}</td>
                                            <td>{{ $detalle->fecha }}</td>
                                           

                                            <td>
                                                <form action="{{ route('detalle-gastos.destroy', $detalle->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('detalle-gastos.show', $detalle->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('detalle-gastos.edit', $detalle->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
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
    <form action="{{ route('detalle-gastos.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar detalle de gasto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @includeif('partials.errors')

                        @csrf

                        <div class="mb-3">

                            <label for="tipo">No. Factura</label>
                            <input type="text" name="numero_factura" class="form-control" placeholder="No. Factura" required>

                            {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="id_tipo">Tipo</label>
                            <select name="id_tipo" class="form-select" id="id_tipo" aria-label="Default select example"
                                required>
                                <option selected="true" disabled="disabled">Seleccione un tipo de gasto</option>
                                @foreach ($gastos as $gasto)
                                    <option value="{{ $gasto->id }}">{{ $gasto->tipo }}</option>
                                @endforeach
                            </select>

                            {!! $errors->first('id_tipo', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="monto">Monto</label>
                            <input type="number" step="0.01" name="monto" class="form-control" placeholder="Monto" required>

                            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>

                            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                        <div class="mb-3">

                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" class="form-control" placeholder="Fecha" required>

                            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}

                        </div>

                      

                        <div class="mb-3">

                            <label for="iva">Agregar IVA</label>
                            
                            <select name="iva" id="iva" class="form-select" aria-label="Default select example" required>
                                <option value="" selected="true" disabled="disabled">Seleccione si desea agregar iva</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>


                            </select>

                            {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}

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
    </script>
@endsection
