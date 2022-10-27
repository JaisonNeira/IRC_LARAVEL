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

                                $sql =
                                    "SELECT dep.dep_id, dep.dep_nombre
                                    FROM procesos AS pro
                                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                    INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                                    WHERE pro.pro_estado = 1
                                    AND pro.car_id = " .
                                    $modales->car_id .
                                    "
                                    GROUP BY dep.dep_id, dep.dep_nombre";
                                $departamentos = DB::select($sql);
                            @endphp

                            <div class="col-12 d-flex flex-row ml-3">

                                {{-- select departamento --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="departamento" required>
                                        <option class="form-control" selected disabled>-- Seleccione --</option>
                                        @foreach ($departamentos as $dep)
                                            <option value="{{ $dep->dep_id }}">{{ $dep->dep_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="flex-column">
                                    {{-- select convenio  --}}
                                    <select class="custom-select" id="convenio">

                                    </select>
                                </div>

                                <div class="flex-column">
                                    {{-- select programa  --}}
                                    <select class="custom-select" id="programa">

                                    </select>
                                </div>

                                <div class="flex-column">
                                    {{-- select especialidad --}}
                                    <select class="custom-select" id="especialidad">

                                    </select>
                                </div>

                                {{-- select Municipio --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="municipio">

                                    </select>
                                </div>

                                {{-- select punto de acopio --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="punto_de_acopio">

                                    </select>
                                </div>
                                {{-- select punto de acopio --}}
                                <div class="flex-column">
                                    <select class="custom-select" id="punto_de_acopio">

                                    </select>
                                </div>
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
