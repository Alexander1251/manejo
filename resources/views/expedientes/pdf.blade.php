<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-size: 13px;
        }

        .contenedor {

            margin: 1.2cm 1.2cm 1.2cm 1.2cm;
            width: 600px;
            height: 935px;

            border: 3px solid #000;
        }

        .contenedor1 {

            width: 100%;
            height: 200px;
            border-bottom: 3px solid #000;

        }

        .contendor2-5 {
            width: 100%;
            height: 170px;


        }

        .contenedor2-6 {
            border-bottom: 3px solid #000;
        }

        .center {
            float: left;

            text-align: center;

            height: 100%;
            width: 300px;


        }

        .right {
            float: left;


            height: 100%;


            width: 150px;



        }

        .right img {
            margin: 10px 10px 10px 10px;
        }

        .left {

            float: left;

            height: 100%;

            width: 150px;




        }

        .center1 {
            float: left;

            text-align: center;

            height: 15px;
            width: 200px;


        }

        .right1 {
            float: left;
            text-align: center;


            height: 15px;



            width: 200px;



        }

        .left1 {
            text-align: center;

            float: left;

            height: 15px;

            width: 200px;




        }

        .info-left {
            margin-left: 0px;

            float: left;


            height: 200px;

            width: 400px;
        }

        .info-right {
            margin-left: 15px;

            float: left;


            height: 200px;

            width: 170px;
        }

        .left2 {
            margin-left: 15px;

            float: left;
            border-right: 3px solid #000;

            height: 210px;

            width: 50%;
        }

        .right2 {
            float: left;
            text-align: center;
            

            height: 210px;

            width: 50%;
        }
        .contenedor3{
            height: 210px;
            border-bottom: 3px solid #000;
        }

        .encabezado1 {
            width: 100%;
            height: 20px;

            text-align: center;
            border-bottom: 3px solid #000;

        }

        .encabezado2 {
            width: 100%;
            height: 20px;

            text-align: center;
            border-bottom: 3px solid #000;

        }

        .pie {
            

            text-align: center;
            

        }

        .huella1 {
            border: 2px solid #000;
            height: 40%;
        }

        .huella2 {
            margin-top: -2px;
            border: 2px solid #000;
            height: 40%;
        }


        .contenedor2 {
            width: 100%;
            height: 20px;


        }
    </style>
</head>

<body>


    <div class="contenedor">
        <div class="contenedor1">
            <div class="left"></div>
            <div class="center">
                <p>Autorizado por el VMT</p>
                <P>FICHA DE CONTROL DE EXAMENES</P>

            </div>
            <div class="right">
                <img src="{{ $foto }}" alt="" width="130px" height="180px">
            </div>

        </div>
        <div class="encabezado1">
            <p><b>DATOS GENERALES</b></p>

        </div>
        <div class="contenedor2">
            <div class="left1"><b>FECHA:</b> {{ date('d-m-Y') }}</div>
            <div class="center1"><b>FACTURA No.</b> {{ $expediente->id }}</div>
            <div class="right1"><b>REGISTRO: {{$expediente->registro}}</b> </div>
        </div>
        <p style="margin-left: 15px; text-transform: uppercase;"><b>NOMBRE SOLICITANTE:</b>
            {{ $expediente->cliente->nombres }} {{ $expediente->cliente->apellidos }}</p>
        <br>
        <div class="contendor2-5">
            @if ($expediente->cliente->pasaporte != null)
            <div class="info-left">
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>TIPO DE DOCUMENTO:</b> PASAPORTE</p> <br>
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>NUMERO DE DOCUMENTO:</b>
                    {{ $expediente->cliente->pasaporte }}</p>

            </div>
            @else
            @if ($expediente->cliente->minoridad != null)
            <div class="info-left">
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>TIPO DE DOCUMENTO:</b> MINORIDAD</p> <br>
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>NUMERO DE DOCUMENTO:</b>
                    {{ $expediente->cliente->minoridad }}</p>

            </div>
            @else
            <div class="info-left">
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>TIPO DE DOCUMENTO:</b> DUI</p> <br>
                <p style="margin-left: 15px; text-transform: uppercase;"> <b>NUMERO DE DOCUMENTO:</b>
                    {{ $expediente->cliente->dui }}</p>

            </div>
            @endif
            @endif
            <div class="info-right">
                <div class="huella1"></div>
                <div class="huella2"></div>

            </div>
        </div>
        <div class="contenedor2-6">
            <p style="margin-left: 15px; text-transform: uppercase;"> <b>CLASE DE TRAMITE: </b> {{$expediente->ingreso->ingreso}}
                &nbsp;&nbsp;&nbsp; <b>CATEGORIA DE LICENCIA: </b> {{ $expediente->licenciaTipo->licencia }}</p>
            <p style="margin-left: 15px; text-transform: uppercase;"><b>ESCUELA DE MANEJO: </b> {{$expediente->escuela->escuela}}</p>
        </div>
        <div class="encabezado2">
            <p><b>RESULTADOS</b></p>

        </div>
        <div class="contenedor3">
            <div class="left2">
                <p><b>Exámenes Aprobados:</b> </p>
                <p>VISUAL: {{$expediente->fecha_examen_visual}} </p>
                <p>TEORICO: {{$expediente->fecha_examen_teorico}} </p>
                <p>PRACTICO: {{$expediente->fecha_examen_practico}} </p>
                <p><b>Datos del Vehículo</b></p>
                <p>PLACAS: </p>
                <p>CAPACIDAD: </p>
            </div>
            

            <div class="right2">
                <p><b>Firmas: <br><br><br><br>______________________ <br>Solicitante <br><br><br><br> ______________________ <br>Firma Autorizada </b></p>
            </div>

        </div>
        <div class="pie">
<p>Recuerde que: <b>ESTE DOCUMENTO NO LO AUTORIZA PARA CONDUCIR</b></p>
<p>TRAMITE VALIDO POR UN AÑO</p>
        </div>
    </div>



</body>

</html>
