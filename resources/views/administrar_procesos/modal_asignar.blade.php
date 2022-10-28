@php
    use app\models\departamento;
    use Illuminate\Support\Facades\DB;
@endphp


@foreach ($cargues as $modales)
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
                            <div class="col-12 mb-2" style="text-align: left">
                                <h5>Escoge el tipo de segmentacion</h5>
                            </div>
                            @php
                                //Departamento
                                $sql =
                                    "SELECT dep.dep_id, dep.dep_nombre
                                        FROM procesos AS pro
                                        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                                        WHERE pro.pro_estado = 1
                                        AND pro.car_id = ".$modales->car_id.
                                    ' GROUP BY dep.dep_id, dep.dep_nombre';
                                $departamentos = DB::select($sql);

                                //Municipio
                                $sql2 =
                                    "SELECT mun.mun_id, mun.mun_nombre
                                       FROM procesos AS pro
                                       INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                       INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                                       WHERE pro.pro_estado = 1
                                       AND pro.car_id = " .$modales->car_id.
                                    ' GROUP BY mun.mun_id, mun.mun_nombre';
                                $municipio = DB::select($sql2);

                                //Prioridad
                                $sql3 =
                                    "SELECT pro.pro_prioridad
                                        FROM procesos AS pro
                                        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                                        WHERE pro.pro_estado = 1
                                        AND pro.car_id =" .$modales->car_id.
                                      ' GROUP BY pro.pro_prioridad';
                                $prioridad = DB::select($sql3);
                            @endphp


                            <div class="d-flex flex-row ml-3 text-center">
                                {{-- -->  inicio los que siempre salen  <-- --}}
                                {{-- select departamento --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="departamento" required>
                                        <option class="form-control" selected disabled>Departamento</option>
                                        @foreach ($departamentos as $dep)
                                            <option value="{{ $dep->dep_id }}">{{ $dep->dep_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- select Municipio --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="municipio">
                                        <option class="form-control" selected disabled>Municipio</option>
                                        @foreach ($municipio as $mun)
                                            <option value="{{ $mun->mun_id }}">{{ $mun->mun_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- select prioridad --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="prioridad">
                                        <option class="form-control" selected disabled>Prioridad</option>
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
                                                $sql_conv_ina= "SELECT ina.ina_convenio_nombre as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = ".$modales->car_id.
                                                                " GROUP BY ina.ina_convenio_nombre";
                                                $convenio = DB::select($sql_conv_ina);
                                                break;
                                            case 5:
                                                $sql_conv_bri= "SELECT bri.bri_convenio as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = ".$modales->car_id.
                                                                " GROUP BY bri.bri_convenio";
                                                $convenio = DB::select($sql_conv_bri);
                                                break;
                                            case 3:
                                                $sql_conv_reco= "SELECT rec.rec_convenio as convenio
                                                                    FROM procesos AS pro
                                                                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id = ".$modales->car_id.
                                                                    " GROUP BY rec.rec_convenio";
                                                $convenio = DB::select($sql_conv_reco);
                                                break;
                                            case 6:
                                                $sql_conv_rep = "SELECT rep.rep_convenio as convenio
                                                                FROM procesos AS pro
                                                                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id = ".$modales->car_id.
                                                                " GROUP BY rep.rep_convenio";
                                                $convenio = DB::select($sql_conv_rep);
                                                break;

                                            default:

                                                break;
                                        }
                                    @endphp
                                    <div class="flex-column">
                                        <select class="custom-select" id="convenio">
                                            <option class="form-control" selected disabled>Convenio</option>
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
                                        $sql_pro_hosp = "SELECT hos.hos_programa as programa
                                                            FROM procesos AS pro
                                                            INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                            WHERE pro.pro_estado = 1
                                                            AND pro.car_id =".$modales->car_id.
                                                            " GROUP BY hos.hos_programa";
                                        $programa = DB::select($sql_espe_hosp);
                                    @endphp
                                    <div class="flex-column">
                                        <select class="custom-select" id="programa">
                                            <option class="form-control" selected disabled>Programa</option>
                                            @foreach ($programa as $pro)
                                                <option value="{{ $pro->programa }}">{{ $pro->programa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                {{-- select especialidad --}}
                                @if ($modales->tpp_id == 1 || $modales->tpp_id == 2 || $modales->tpp_id == 3 || $modales->tpp_id == 6)
                                    @php
                                        switch ($modales->tpp_id) {
                                            case 1:
                                                $sql_espe_ina ="SELECT ina.ina_medico_especialidad as especialidad
                                                                FROM procesos AS pro
                                                                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                                                                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                WHERE pro.pro_estado = 1
                                                                AND pro.car_id =" .$modales->car_id.
                                                                " GROUP BY ina.ina_medico_especialidad";
                                                 $especialidad = DB::select($sql_espe_ina);

                                                break;
                                            case 2:
                                                $sql_espe_seg = "SELECT seg.sdi_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =" .$modales->car_id.
                                                                    " GROUP BY seg.sdi_especialidad";
                                                  $especialidad = DB::select($sql_espe_seg);
                                                break;
                                            case 3:
                                                $sql_espe_reco = "SELECT rec.rec_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =".$modales->car_id.
                                                                    " GROUP BY rec.rec_especialidad";
                                                 $especialidad = DB::select($sql_espe_reco);
                                                break;
                                            case 6:
                                                $sql_espe_repo = "SELECT rep.rep_especialidad as especialidad
                                                                    FROM procesos AS pro
                                                                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                                                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                                    WHERE pro.pro_estado = 1
                                                                    AND pro.car_id =".$modales->car_id.
                                                                    " GROUP BY rep.rep_especialidad";
                                                $especialidad = DB::select($sql_espe_repo);
                                                break;

                                            default:
                                                # code...
                                                break;
                                        }
                                    @endphp
                                    <div class="flex-column">
                                        <select class="custom-select" id="especialidad">
                                            <option class="form-control" selected disabled>Especialidad</option>
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
                                        $sql_punto_bri = "SELECT bri.bri_punto_acopio as punto_acopio
                                                            FROM procesos AS pro
                                                            INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                                            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                                            WHERE pro.pro_estado = 1
                                                            AND pro.car_id =".$modales->car_id.
                                                            " GROUP BY bri.bri_punto_acopio";
                                        $punto_acopio = DB::select($sql_punto_bri);

                                    @endphp
                                    <div class="flex-column">
                                        <select class="custom-select" id="punto_de_acopio">
                                            <option class="form-control" selected disabled>Punto de acopio</option>
                                            @foreach ($punto_acopio as $punto)
                                                <option value="{{ $punto->punto_acopio }}">{{ $punto->punto_acopio }}
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
                                            <th scope="col">Identificacion</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Asignar</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #ffff; text-align: center;" id="registros_asignar"
                                        name="registros_asignar">
                                        {{-- <tr>
                                            <td>1042241113</td>
                                            <td>Jaison</td>
                                            <td>Neira</td>
                                            <td>
                                                <input type="checkbox" id="cbox1" value="first_checkbox">
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Asignar agentes</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
