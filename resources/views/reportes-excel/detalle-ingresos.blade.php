<table class="table">
    <thead>
        <tr>
            <th colspan="8"><b>DETALLE DE INGRESOS PARA EL MES: {{ date('M-Y', strtotime($fecha)) }}</b></th>
            
        </tr>

        <tr>
            @if ($escuelaF != null)
            <th colspan="2"><b>Escuela:</b></th>
            <th colspan="4">{{$escuelaF->escuela}}</th>
        
                
            @else
            <th colspan="2"><b>Escuela:</b></th>
            <th colspan="4">Todas las escuelas</th>  
          
        @endif
        </tr>

        


        <tr>
            <th></th>
            @php
                $totales = [];
                $totalesC = [];
                $diasDelMes = cal_days_in_month(
                    CAL_GREGORIAN,
                    date('m', strtotime($fecha)),
                    date('Y', strtotime($fecha)),
                );
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    echo '<th colspan="2">' .
                        date('d/m/Y', strtotime($fecha . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT))) .
                        '</th>';
                }
            @endphp

            <th colspan="2">GENERAL</th>




        </tr>

        <tr>
            <th>INGRESO</th>

            @php

                $diasDelMes = cal_days_in_month(
                    CAL_GREGORIAN,
                    date('m', strtotime($fecha)),
                    date('Y', strtotime($fecha)),
                );
                for ($dia = 1; $dia <= $diasDelMes; $dia++) {
                    echo '<th>CANTIDAD</th> <th>TOTAL</th>';
                }
            @endphp

            <th>CANTIDAD</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ingresos as $ingreso)
            @php

                $suma = 0;
                $sumaC = 0;

                foreach ($diarios[$ingreso->id] as $diario) {
                    $suma += $diario['total'];
                    $sumaC += $diario['cantidad'];
                }

                $totales[$loop->iteration - 1] = $suma;
                $totalesC[$loop->iteration - 1] = $sumaC;

                if ($sumaC == 0) {
                    continue;
                }
            @endphp
            <tr>

                <th>{{ $ingreso->ingreso }}</th>
                @foreach ($diarios[$ingreso->id] as $diario)
                    <td>{{ $diario['cantidad'] }}</td>
                    <td>${{ $diario['total'] }}</td>
                @endforeach
                @php
                    echo '<td> ' . $sumaC . '</td>';
                    echo '<td> $' . $suma . '</td>';

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
                    $sumaC = 0;
                    foreach ($ingresos as $ingreso) {
                        $suma += $diarios[$ingreso->id][$dia]['total'];
                        $sumaC += $diarios[$ingreso->id][$dia]['cantidad'];
                    }

                    echo '<td> ' . $sumaC . '</td>';
                    echo '<td> $' . $suma . '</td>';
                }

            @endphp


            @php
                $totalG = 0;
                foreach ($totales as $total) {
                    $totalG += $total;
                }

                $totalG2 = 0;
                foreach ($totalesC as $total) {
                    $totalG2 += $total;
                }

                echo '<td> ' . $totalG2 . '</td>';
                echo '<td> $' . $totalG . '</td>';
            @endphp


        </tr>





    </tbody>
</table>
