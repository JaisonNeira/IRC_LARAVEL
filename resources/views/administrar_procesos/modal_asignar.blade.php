@php
    use app\models\departamento;
    use Illuminate\Support\Facades\DB;
@endphp


@foreach ($cargues as $modales)
    <form action="{{ route('asignar.segmentacion') }}" method="POST" name="form-data" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal_{{ $modales->car_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#E22A3D;">
                        <h4 style="color: #fff; font-wight: bold;">Asignar Agente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 mb-2" style="text-align: left">
                                    <h5>Escoge el tipo de segmentacion</h5>
                                </div>
                                <div class="col-6 mb-2 text-right" style="text-align: left">
                                    <h6>Registros encontrados: <span class="span_red"
                                            id="registro_span_{{ $modales->car_id }}"></span> </h6>
                                </div>
                                @php
                                    //Departamento
                                    $sql =
                                        "SELECT dep.dep_id, dep.dep_nombre
                                            FROM procesos AS pro
                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                                            WHERE pro.pro_estado = 1
                                            AND pro.car_id = " .
                                        $modales->car_id .
                                        ' GROUP BY dep.dep_id, dep.dep_nombre';
                                    $departamentos = DB::select($sql);

                                    //Municipio
                                    $sql2 =
                                        "SELECT mun.mun_id, mun.mun_nombre
                                        FROM procesos AS pro
                                        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                                        WHERE pro.pro_estado = 1
                                        AND pro.car_id = " .
                                        $modales->car_id .
                                        ' GROUP BY mun.mun_id, mun.mun_nombre';
                                    $municipio = DB::select($sql2);

                                    //Prioridad
                                    $sql3 =
                                        "SELECT pro.pro_prioridad
                                            FROM procesos AS pro
                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                                            WHERE pro.pro_estado = 1
                                            AND pro.car_id =" .
                                        $modales->car_id .
                                        ' GROUP BY pro.pro_prioridad';
                                    $prioridad = DB::select($sql3);
                                @endphp
                                <div class="d-flex flex-row ml-3 text-center">
                                    {{-- -->  inicio los que siempre salen  <-- --}}
                                    {{-- select departamento --}}
                                    <div class="flex-column">
                                        <select class="custom-select" id="departamento_{{ $modales->car_id }}"
                                            name="departamento"
                                            onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                            <option class="form-control" value="" selected disabled>Departamento
                                            </option>
                                            @foreach ($departamentos as $dep)
                                                <option value="{{ $dep->dep_id }}">{{ $dep->dep_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- select Municipio --}}
                                    <div class="flex-column">
                                        <select class="custom-select" id="municipio_{{ $modales->car_id }}"
                                            name="municipio"
                                            onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                            <option class="form-control" value="" selected disabled>Municipio
                                            </option>
                                            @foreach ($municipio as $mun)
                                                <option value="{{ $mun->mun_id }}">{{ $mun->mun_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- select prioridad --}}
                                    <div class="flex-column">
                                        <select class="custom-select" id="prioridad_{{ $modales->car_id }}"
                                            name="prioridad""
                                            onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                            <option class="form-control" value="" selected disabled>Prioridad
                                            </option>
                                            @foreach ($prioridad as $prio)
                                                <option value="{{ $prio->pro_prioridad }}">{{ $prio->pro_prioridad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- -->    fin los que siempre salen    <-- --}}

                                    {{-- select convenio  --}}
                                    @if ($modales->tpp_id == 1 || $modales->tpp_id == 5 || $modales->tpp_id == 3 || $modales->tpp_id == 6)
                                        @php
                                            switch ($modales->tpp_id) {
                                                case 1:
                                                    $sql_conv_ina =
                                                        "SELECT ina.ina_convenio_nombre as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = " .
                                                        $modales->car_id .
                                                        ' GROUP BY ina.ina_convenio_nombre';
                                                    $convenio = DB::select($sql_conv_ina);
                                                    break;
                                                case 5:
                                                    $sql_conv_bri =
                                                        "SELECT bri.bri_convenio as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = " .
                                                        $modales->car_id .
                                                        ' GROUP BY bri.bri_convenio';
                                                    $convenio = DB::select($sql_conv_bri);
                                                    break;
                                                case 3:
                                                    $sql_conv_reco =
                                                        "SELECT rec.rec_convenio as convenio
                                                                    FROM procesos AS pro
                                                                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id = " .
                                                        $modales->car_id .
                                                        ' GROUP BY rec.rec_convenio';
                                                    $convenio = DB::select($sql_conv_reco);
                                                    break;
                                                case 6:
                                                    $sql_conv_rep =
                                                        "SELECT rep.rep_convenio as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = " .
                                                        $modales->car_id .
                                                        ' GROUP BY rep.rep_convenio';
                                                    $convenio = DB::select($sql_conv_rep);
                                                    break;

                                                default:
                                                    break;
                                            }
                                        @endphp
                                        <div class="flex-column">
                                            <select class="custom-select" id="convenio_{{ $modales->car_id }}"
                                                name="convenio"
                                                onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                                <option class="form-control" value="" selected disabled>Convenio
                                                </option>
                                                @foreach ($convenio as $conv)
                                                    <option value="{{ $conv->convenio }}">{{ $conv->convenio }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    {{-- select programa  --}}
                                    @if ($modales->tpp_id == 4)
                                        @php
                                            $sql_pro_hosp =
                                                "SELECT hos.hos_programa as programa
                                                            FROM procesos AS pro
                                                            INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                            WHERE pro.pro_estado = 1
                                                            AND pro.car_id =" .
                                                $modales->car_id .
                                                ' GROUP BY hos.hos_programa';
                                            $programa = DB::select($sql_pro_hosp);
                                        @endphp
                                        <div class="flex-column">
                                            <select class="custom-select" id="programa_{{ $modales->car_id }}"
                                                name="programa"
                                                onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                                <option class="form-control" value="" selected disabled>Programa
                                                </option>
                                                @foreach ($programa as $pro)
                                                    <option value="{{ $pro->programa }}">{{ $pro->programa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    {{-- select especialidad --}}
                                    @if ($modales->tpp_id == 1 ||
                                        $modales->tpp_id == 2 ||
                                        $modales->tpp_id == 3 ||
                                        $modales->tpp_id == 5 ||
                                        $modales->tpp_id == 6)
                                        @php
                                            switch ($modales->tpp_id) {
                                                case 1:
                                                    $sql_espe_ina =
                                                        "SELECT ina.ina_medico_especialidad as especialidad
                                                                FROM procesos AS pro
                                                                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id =" .
                                                        $modales->car_id .
                                                        ' GROUP BY ina.ina_medico_especialidad';
                                                    $especialidad = DB::select($sql_espe_ina);

                                                    break;
                                                case 2:
                                                    $sql_espe_seg =
                                                        "SELECT seg.sdi_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =" .
                                                        $modales->car_id .
                                                        ' GROUP BY seg.sdi_especialidad';
                                                    $especialidad = DB::select($sql_espe_seg);
                                                    break;
                                                case 3:
                                                    $sql_espe_reco =
                                                        "SELECT rec.rec_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =" .
                                                        $modales->car_id .
                                                        ' GROUP BY rec.rec_especialidad';
                                                    $especialidad = DB::select($sql_espe_reco);
                                                    break;
                                                case 5:
                                                    $sql_espe_bri =
                                                        "SELECT bri.bri_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id = " .
                                                        $modales->car_id .
                                                        ' GROUP BY bri.bri_especialidad';
                                                    $especialidad = DB::select($sql_espe_bri);
                                                    break;
                                                case 6:
                                                    $sql_espe_repo =
                                                        "SELECT rep.rep_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =" .
                                                        $modales->car_id .
                                                        ' GROUP BY rep.rep_especialidad';
                                                    $especialidad = DB::select($sql_espe_repo);
                                                    break;

                                                default:
                                                    # code...
                                                    break;
                                            }
                                        @endphp
                                        <div class="flex-column">
                                            <select class="custom-select" id="especialidad_{{ $modales->car_id }}"
                                                name="especialidad"
                                                onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                                <option class="form-control" value="" selected disabled>
                                                    Especialidad</option>
                                                @foreach ($especialidad as $esp)
                                                    <option value="{{ $esp->especialidad }}">{{ $esp->especialidad }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    {{-- select punto de acopio --}}
                                    @if ($modales->tpp_id == 5)
                                        @php
                                            $sql_punto_bri =
                                                "SELECT bri.bri_punto_acopio as punto_acopio
                                                            FROM procesos AS pro
                                                            INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                            WHERE pro.pro_estado = 1
                                                            AND pro.car_id =" .
                                                $modales->car_id .
                                                ' GROUP BY bri.bri_punto_acopio';
                                            $punto_acopio = DB::select($sql_punto_bri);

                                        @endphp
                                        <div class="flex-column">
                                            <select class="custom-select" id="punto_de_acopio_{{ $modales->car_id }}"
                                                name="punto_de_acopio"
                                                onchange="consulta({{ $modales->car_id }}, {{ $modales->tpp_id }})">
                                                <option class="form-control" value="" selected disabled>Punto de
                                                    acopio</option>
                                                @foreach ($punto_acopio as $punto)
                                                    <option value="{{ $punto->punto_acopio }}">
                                                        {{ $punto->punto_acopio }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-3">
                                    <table id="table2" class="table table-bordered">
                                        <thead
                                            style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                            <tr>
                                                <th class="text-center th_a py-3">
                                                    Identificacion</th>
                                                <th class="text-center th_a py-3">Nombre Completo</th>
                                                <th class="text-center py-3 px-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="seleccionar_todo">
                                                        <label class="form-check-label" for="selecionar_todo">
                                                            Seleccionar todos
                                                        </label>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: #ffff; text-align: center;"
                                            id="registros_asignar" name="registros_asignar">


                                            @foreach ($agentes as $agente)
                                                <tr>
                                                    <td>{{ $agente->age_documento }}</td>
                                                    <td>{{ $agente->name }}</td>
                                                    <td class="mr-3" style="padding-left: 40px;">
                                                        <input class="form-check-input all_select" type="checkbox"
                                                            name="ids[]" value="{{ $agente->age_id }}"
                                                            id="check_{{ $agente->age_id }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="tpp_id" id="tpp" value="{{ $modales->tpp_id }}"
                        style="display: none">
                    <input type="text" name="car_id" id="car" value="{{ $modales->car_id }}"
                        style="display: none">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Asignar agentes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach
