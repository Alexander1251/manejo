<table class="table">
    <thead>
        <tr>
            <th colspan="4"><b>FLUJO DE EFECTIVO PARA EL MES: {{date('M-Y', strtotime($fecha))}}</b></th>
        </tr>
        <tr>
            <th>FECHA</th>
            <th>INGRESOS</th>
            <th>GASTOS</th>

            <th>SALDO A LA FECHA</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($diarios as $diario)
            <tr>
                <td>{{ date('d-M-Y', strtotime($diario['fecha']))}}</td>
                <td>${{number_format($diario['sumaI'],2)}}</td>
                <td>${{number_format($diario['sumaG'],2)}}</td>
                <td>${{number_format($diario['acumulado'],2)}}</td>
            </tr>
        @endforeach

        <tr>
            <th></th>
            <th>${{$totalI}}</th>
            <th>${{$totalG}}</th>
            <th>${{$saldoInicial + $totalI - $totalG}}</th>
        </tr>

    </tbody>
</table>