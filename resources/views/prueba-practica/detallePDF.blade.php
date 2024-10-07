<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 15px 15px 20px 20px;
        }
    </style>
</head>
<body>

    <h4>Examen realizado por: {{ $examen->expediente->cliente->nombres }} {{$examen->expediente->cliente->apellidos}}</h4>
    <h4>Fecha: {{$examen->fecha_examen}} Calificación: {{$examen->calificacion}}</h4>

    @foreach ($examen->detalles as $detalle)

    <p>{{$loop->iteration}}. {{$detalle->pregunta->pregunta}}</p>
    <p>{{$detalle->resultado}}</p>
        
    @endforeach
    
</body>
</html>