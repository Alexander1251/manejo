@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Usuario
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
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Actualizar usuario') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> {{ __('Regresar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-3">

                                <label for="nombres">Nombres *</label>
                                <input value="{{$usuario->nombres}}" type="text" name="nombres" class="form-control" placeholder="Nombres" required>
    
                                {!! $errors->first('nombres', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="apellidos">Apellidos *</label>
                                <input value="{{$usuario->apellidos}}" type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
    
                                {!! $errors->first('apellidos', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3">

                                <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                                <input value='{{$usuario->fecha_nacimiento}}' type="date" name="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" required>
    
                                {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3"> <label for="dui">Dui *</label>
                                <input id="dui" maxlength="10" value="{{$usuario->dui}}" type="text" name="dui" class="form-control" placeholder="Dui">
    
                                {!! $errors->first('dui', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="minoridad">Minoridad </label>
                                <input value="{{$usuario->minoridad}}" id="minoridad" type="text" maxlength="10" name="minoridad" class="form-control"
                                    placeholder="Minoridad">
    
                                {!! $errors->first('minoridad', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="pasaporte">Pasaporte </label>
                                <input value="{{$usuario->pasaporte}}" id="pasaporte" type="text"  name="pasaporte"
                                    class="form-control" placeholder="Pasaporte">

                                {!! $errors->first('pasaporte', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                            <div class="mb-3"> <label for="nit">Nit</label>
                                <input id="nit" maxlength="17" value="{{$usuario->nit}}" type="text" name="nit" class="form-control" placeholder="Nit " >
    
                                {!! $errors->first('nit', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3" ><label for="nrc">NRC</label>
                                <input value="{{$usuario->nrc}}" type="number" name="nrc" class="form-control" placeholder="NRC " >
    
                                {!! $errors->first('nrc', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="giro">Giro</label>
                                <input value="{{$usuario->giro}}" type="text" name="giro" class="form-control" placeholder="Giro " >
    
                                {!! $errors->first('giro', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="direccion">Dirección</label>
                                <input value="{{$usuario->direccion}}" type="text" name="direccion" class="form-control" placeholder="Dirección" >
    
                                {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="municipio">Municipio</label>
                                <input value="{{$usuario->municipio}}" type="text" name="municipio" class="form-control" placeholder="Municipio" >
    
                                {!! $errors->first('municipio', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>

                            <div class="mb-3"> <label for="departamento">Departamento</label>
                                <input value="{{$usuario->departamento}}" type="text" name="departamento" class="form-control" placeholder="Departamento" >
    
                                {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="sexo">Sexo *</label>
                                <select name="sexo" class="form-select" id="sexo"
                                aria-label="Default select example">


                                @if ($usuario->sexo == 'Femenino')
                                    <option value="Femenino" selected>Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                @else
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino" selected>Masculino</option>
                                @endif

                            </select>
                                {!! $errors->first('sexo', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
    
    
    
    
    
                            <div class="mb-3">

                                <label for="Rol">Rol *</label>
                                <select name="id_rol" class="form-select" id="id_rol"
                                    aria-label="Default select example" required>
                                    
                                    @foreach ($roles as $rol)
                                    @if ($rol->id == $usuario->id_rol)
                                    <option value="{{ $rol->id }}" selected>{{ $rol->rol }}</option>
                                    @else
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                    @endif
                                        
                                    @endforeach
                                </select>

                                {!! $errors->first('id_rol', '<div class="invalid-feedback">:message</div>') !!}

                            </div>
    
    
                            <div class="mb-3">
    
                                <label for="telefono">Telefono *</label>
                                <input value="{{$usuario->telefono}}" type="number" name="telefono" class="form-control" placeholder="Telefono" required>
    
                                {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="usuario">Usuario *</label>
                                <input value="{{$usuario->usuario}}" type="text" name="usuario" class="form-control" placeholder="Usuario" required>
    
                                {!! $errors->first('usuario', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="email">Correo</label>
                                <input value="{{$usuario->email}}" value="{{$usuario->correo}}" type="email" name="email" class="form-control" placeholder="Correo">
    
                                {!! $errors->first('emaill', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
                            <div class="mb-3">
    
                                <label for="password">Contraseña *</label>
                                <input  type="text" name="password" class="form-control" placeholder="Deje este campo vacio si no desea actualizar la contraseña"
                                    >
    
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    
                            </div>
    
    
    
    
    
    
                            <div class="mb-3">

                                <label for="estado">Estado *</label>
                                <select name="estado" class="form-select" id="estado"
                                    aria-label="Default select example">


                                    @if ($usuario->estado == 'Activo')
                                        <option value="Activo" selected>Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    @else
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo" selected>Inactivo</option>
                                    @endif

                                </select>

                                {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}

                            </div>

                          

                            <div class="box-footer mt20 text-center mb-3">
                                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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



        }
        else if (largo == 11) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 12) + '-' + valor.slice(12) 
            $(this).val(nuevoValor);



        }
        else if (largo == 15) {
            console.log(valor);

           
            const nuevoValor = valor.slice(0, 16) + '-' + valor.slice(16) 
            $(this).val(nuevoValor);



        }

       



    });
</script>
@endsection