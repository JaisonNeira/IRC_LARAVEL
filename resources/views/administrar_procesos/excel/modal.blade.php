<!-- Modal -->
<div class="modal fade" id="segmentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#E22A3D;">
                <h4 style="color: #fff; font-wight: bold;">Asignar Agente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('asignar.segmentacion') }}" method="POST" name="form-data"
                enctype="multipart/form-data">
                @csrf
                <input type="text" name="tpp_id" id="modal_tpp_id" value="{{ $tpp_id }}">
                <input type="text" name="car_id" id="modal_car_id" value="{{ $id }}">
                <input type="text" name="departamento" id="modal_departamento">
                <input type="text" name="municipio" id="modal_municipio">
                <input type="text" name="prioridad" id="modal_prioridad">
                <input type="text" name="convenio" id="modal_convenio">
                <input type="text" name="especialidad" id="modal_especialidad">
                <input type="text" name="programa" id="modal_programa">
                <input type="text" name="punto_de_acopio" id="modal_punto_de_acopio">
                <input type="text" name="doctor" id="modal_doctor">
                <input type="text" name="medico" id="modal_medico">
                <input type="text" name="fecha_cita" id="modal_fecha_cita">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <table id="modal_asignar_excel" class="table table-bordered">
                                <thead style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
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
                                <tbody style="background-color: #ffff; text-align: center;" id="registros_asignar"
                                    name="registros_asignar">


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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>
