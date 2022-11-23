<!-- Modal -->
<div class="modal fade" id="editar_paciente_{{ $list->pro_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#E22A3D;">
                <h4 style="color: #fff; font-wight: bold;">Editar paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pacientes.edit.patch') }}" method="POST" name="form-data"
                    enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="row">

                        <input type="text" name="pac_id" id="modal_pac_id" style="display: none;">
                        <input type="text" value="{{ Auth::user()->id }}" name="user_id" style="display: none;">

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Tipo de identificacion</label>
                            <input type="text" class="form-control" id="modal_tip_id" name="tip_id" disabled
                                required>
                        </div>

                        <div class="col-3">
                            <label for="pac_identificacion" class="form-label">Numero de documento</label>
                            <input type="text" class="form-control" id="modal_pac_identificacion"
                                name="pac_identificacion" disabled required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>

                        <div class="col-6">
                            <label for="pac_primer_nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="modal_pac_nombre_completo"
                                name="pac_primer_nombre" disabled required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>

                        <div class="col-4">
                            <label for="pac_fecha_nacimiento" class="form-label">Fecha nacimiento</label>
                            <input type="text" class="form-control" id="modal_pac_fecha_nacimiento" disabled
                                name="pac_fecha_nacimiento">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-4">
                            <label for="pac_direccion" class="form-label">Sexo</label>
                            <input type="text" class="form-control" id="modal_pac_sexo" name="pac_sexo" disabled
                                required>
                        </div>

                        <div class="col-4">
                            <label for="pac_regimen_afiliacion_SGSS" class="form-label">Regimen de
                                afiliacion</label>
                            <input type="text" class="form-control" id="modal_pac_regimen_afiliacion_SGSS"
                                disabled name="pac_regimen_afiliacion_SGSS">
                        </div>

                        <div class="col-4">
                            <label for="pac_direccion" class="form-label">Departamento</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="dep_id" id="modal_dep_id" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="pac_direccion" class="form-label">Municipio</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="mun_id" id="modal_mun_id" aria-label="Default select example" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                </select>
                            </div>
                            <br>
                        </div>

                        <div class="col-4">
                            <label for="pac_telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="modal_pac_telefono" name="pac_telefono"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-4">
                            <label for="pac_direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="modal_pac_direccion" name="pac_direccion"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary col-4">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
