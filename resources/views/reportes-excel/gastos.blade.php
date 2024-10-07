<table class="table" id="Tabla">
    <thead>
        <tr >
            <th colspan="9"><b>REPORTE GENERAL DE GASTOS DESDE {{ date('d-M-Y', strtotime($fechaInicio)) }} AL
                {{ date('d-M-Y', strtotime($fechaFin)) }}</b> </th>

        </tr>
        <tr>
            <th>FECHA</th>
            <th>DIA</th>
            <th>MES</th>
            <th>FACTURA</th>
            <th>TIPO</th>
            <th>MONTO SIN IVA</th>
            <th>IVA</th>
            <th>Descripción</th>
           

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
                <td>{{ $detalle->gasto->tipo }}</td>
                <td>${{$detalle->monto}}</td>
                <td>${{$detalle->iva}}</td>
              
                <td>{{$detalle->descripcion}}</td>
                <td>${{ $detalle->total }}</td>
            </tr>
        @endforeach
        <!-- Aquí van las filas de gastos -->
    </tbody>
</table>