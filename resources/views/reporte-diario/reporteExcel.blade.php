<table>
    <tr>
        <th  colspan="6"><b>REPORTE OPERATIVO DIARIO</b></th>

    </tr>
    <tr>
        <th colspan="6"><b>Utilidad desde la fecha {{ date('d-M-Y', strtotime($fechaInicio)) }} al
            {{ date('d-M-Y', strtotime($fechaFin)) }} : ${{ $totalI - $totalG }}</b></th>
    </tr>
</table>


<table class="table" >
    <thead>
        
        <tr>
            <th colspan="3"><b>Ingresos</b></th>
        </tr>
        
        <tr>
            <th>TIPO</th>
            <th>CANTIDAD</th>

            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
      

        @foreach ($ingresos as $ingreso)
            <tr>
                <td>{{ $ingreso->ingreso->ingreso }}</td>
                <td>{{ $ingreso->cantidad}}</td>
                <td>${{ $ingreso->total }}</td>
            </tr>
        @endforeach
        <tr>
            <th>Total: </th>
            <th></th>
            <th>$ {{$totalI}}</th>
        </tr>
    </tbody>
</table>

<table class="table">
    <thead>
        
        <tr>
            <th><b>Gastos</b></th>
        </tr>
        
        <tr>
            <th>TIPO</th>

            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detalles as $detalle)
            <tr>
                <td>{{ $detalle->gasto->tipo }}</td>
                <td>${{ $detalle->total }}</td>
            </tr>
        @endforeach
        <tr>
            <th>Total: </th>
            <th>$ {{$totalG}}</th>
        </tr>
        <!-- Aquí van las filas de gastos -->
    </tbody>
</table>