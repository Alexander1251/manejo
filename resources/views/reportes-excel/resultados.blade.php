<table class="table">
    <thead>
        <tr>
            @if ($estatus == 'Aprobados')
            
                <th colspan="7"><b>REPORTE GENERAL DE APROBADOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }}
                    AL
                    {{ date('d-M-Y', strtotime($fechaFin)) }}</b></th>
        @else
           
                <th colspan="7"><b>REPORTE GENERAL DE REPROBADOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }}
                    AL
                    {{ date('d-M-Y', strtotime($fechaFin)) }}</b></th>
        @endif
            
        </tr>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Calificación</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)

        <tr>
            <td>{{$cliente->expediente->cliente->nombres}}</td>
            <td>{{$cliente->expediente->cliente->apellidos}}</td>
            <td>{{$cliente->calificacion}}</td>
            <td>{{$cliente->fecha_examen}}</td>
        </tr>
            
        @endforeach
    </tbody>
</table>