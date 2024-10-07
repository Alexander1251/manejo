<table class="table" id="Tabla">
    <thead>
        <tr>
            <th colspan="9"><b>REPORTE GENERAL DE INGRESOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }} AL
                {{ date('d-M-Y', strtotime($fechaFin)) }}</b></th>
        </tr>
        <tr>
            <th>FECHA</th>
            <th>DIA</th>
            <th>MES</th>
            <th>FACTURA</th>
            <th>TIPO</th>
            <th>CANTIDAD</th>
            <th>ESCUELA</th>
            <th>VALOR</th>
           

            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td>{{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->format('d/m/Y') }}</td>
                <td> {{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->isoFormat('dddd ')}}</td>
                <td> {{ \Carbon\Carbon::parse(strtotime($detalle->fecha))->isoFormat('MMMM ')}}</td>
                <td>{{$detalle->numero_factura}}</td>
                <td>{{ $detalle->ingreso->ingreso }}</td>
                <td>{{$detalle->cantidad}}</td>
                <td>{{$detalle->procedencia->escuela}}</td>
                <td>${{ $detalle->monto }}</td>
                <td>${{$detalle->total}}</td>
            </tr>
        @endforeach

        
        <!-- Aquí van las filas de gastos -->
    </tbody>
</table>