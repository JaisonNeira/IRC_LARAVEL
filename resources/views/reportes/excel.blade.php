<table>
    <thead>

        <tr>
            <th colspan="1" style="text-align: center;"> Reporte de {{$tipo_proceso}} del municipio de {{$departamento}}</th>
            <th>Total de gestiones: </th>
            <th style="text-align: center;">{{$cantidad}}</th>
        </tr>

        <tr>
            <th colspan="1" style="text-align: center;">Fecha inicial: {{$fecha_ini}}, Fecha Final: {{$fecha_fin}}</th>
            <th>Gestiones Pendientes: </th>
            <th style="text-align: center;">{{$faltantes}}</th>
        </tr>

        <tr>
            <th colspan="1" style="text-align: center;">Srs. Riesgo Cardiovascular Y Obstetrico Irc S.A.S.</th>
            <th>Total de procesos: </th>
            <th style="text-align: center;">{{$total}}</th>
        </tr>

        <tr>
            <th colspan="1" style="text-align: center;"> NIT: 900781044</th>
            <th>Porcentaje de cumplimiento:</th>
            <th style="text-align: center;">{{$cumplimiento}}</th>
        </tr>

        <tr>
            @for ($i = 0; $i < $columnas + 1; $i++)
                <th>{{ $matriz[0][$i] }}</th>
            @endfor
        </tr>

    </thead>
    <tbody>
        @for ($i1 = 1; $i1 < $filas + 1; $i1++)
            <tr>
                @for ($i2 = 0; $i2 < $columnas + 1; $i2++)
                    <td>{{ $matriz[$i1][$i2] }}</td>
                @endfor
            </tr>
        @endfor
    </tbody>
</table>
