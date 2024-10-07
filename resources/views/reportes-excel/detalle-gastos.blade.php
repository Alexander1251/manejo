<table class="table">
    <thead>
        <tr>
            <th colspan="6"><b>DETALLE DE GASTOS PARA EL MES: {{ date('M-Y', strtotime($fecha)) }}</b></th>
        </tr>
        <tr>
            <th>TIPO</th>
            @php
                $totales = [];
                $diasDelMes = cal_days_in_month(
                    CAL_GREGORIAN,
                    date('m', strtotime($fecha)),
                    date('Y', strtotime($fecha)),
                );
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    echo '<th>' .
                        date(
                            'd/m/Y',
                            strtotime(
                                $fecha .
                                    '-' .
                                    str_pad($dia, 2, '0', STR_PAD_LEFT),
                            ),
                        ) .
                        '</th>';
                }
            @endphp

            <th>TOTAL</th>




        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $gasto)
            @php

                $suma = 0;

                foreach ($diarios[$gasto->id] as $diario) {
                    $suma += $diario['total'];
                }

                if ($suma == 0) {

                    continue;
                }

                $totales[$loop->iteration - 1] = $suma;

              
            @endphp
            <tr>

                <th>{{ $gasto->tipo }}</th>
                @foreach ($diarios[$gasto->id] as $diario)
                    <td>${{ $diario['total'] }}</td>
                @endforeach
                @php
                    echo '<td>$' . $suma . '</td>';
                @endphp

            </tr>
        @endforeach
        <tr>
            <th>TOTAL</th>
            @php

                $diasDelMes = cal_days_in_month(
                    CAL_GREGORIAN,
                    date('m', strtotime($fecha)),
                    date('Y', strtotime($fecha)),
                );
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    $suma = 0;
                    foreach ($gastos as $gasto) {
                        $suma += $diarios[$gasto->id][$dia]['total'];
                    }
                    echo '<td> $' . $suma . '</td>';
                }

            @endphp

            <td>
                @php
                    $totalG = 0;
                    foreach ($totales as $total) {
                        $totalG += $total;
                    }

                    echo '$' . $totalG;
                @endphp

            </td>
        </tr>





    </tbody>
</table>