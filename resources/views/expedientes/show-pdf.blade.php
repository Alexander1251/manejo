<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            line-height: 1.5;

        }

        .container {
            margin-left: 25px;
        }

        .mb-3 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4>Información del expediente</h4>
        <div class="mb-3">
            <strong>Cliente:</strong>
            {{ $expediente->cliente->nombres }} {{ $expediente->cliente->apellidos }}
        </div>

        <div class="mb-3">
            <strong>Factura:</strong>
            {{ $expediente->factura }}
        </div>

        <div class="mb-3">
            <strong>Registro:</strong>
            {{ $expediente->registro }}
        </div>


        <div class="mb-3">
            <strong>Tipo de ingreso:</strong>
            {{ $expediente->ingreso->ingreso }}
        </div>

        <div class="mb-3">
            <strong>Licencia:</strong>
            {{ $expediente->licenciaTipo->licencia }}
        </div>

        <div class="mb-3">
            <strong>Escuela:</strong>
            {{ $expediente->escuela->escuela }}
        </div>

        <div class="mb-3">
            <strong>Fecha examen visual:</strong>
            {{ $expediente->fecha_examen_visual }}
        </div>

        <div class="mb-3">
            <strong>Estado examen visual:</strong>
            {{ $expediente->estado_examen_visual }}
        </div>

        <div class="mb-3">
            <strong>Fecha examen teórico:</strong>
            {{ $expediente->fecha_examen_teorico }}
        </div>

        @isset($expediente->examen_teorico)
            <div class="mb-3">
                <strong>Calificación examen teórico:</strong>
                {{ $expediente->examen_teorico->calificacion }}
            </div>
        @endisset

        <div class="mb-3">
            <strong>Estado examen teórico:</strong>
            {{ $expediente->estado_examen_teorico }}
        </div>

        <div class="mb-3">
            <strong>Fecha examen práctico:</strong>
            {{ $expediente->fecha_examen_practico }}
        </div>

        @isset($expediente->examen_practico)
            <div class="mb-3">
                <strong>Calificación examen práctico:</strong>
                {{ $expediente->examen_practico->calificacion }}
            </div>
        @endisset

        <div class="mb-3">
            <strong>Estado examen práctico:</strong>
            {{ $expediente->estado_examen_practico }}
        </div>

        <div class="mb-3">
            <strong>Imagen:</strong>
            <br><br>
            <div><img src="{{ $foto }}" width="100px" height="100px" alt=""></div>
        </div>

        <div class="mb-3">
            <strong>Monto: </strong>
            $ {{ $expediente->monto }}

        </div>
    </div>
</body>

</html>
