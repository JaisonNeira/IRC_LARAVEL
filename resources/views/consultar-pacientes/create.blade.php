<!-- Modal -->
<div class="modal fade" id="crear_paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#E22A3D;">
                <h4 style="color: #fff; font-wight: bold;">Crear paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultas.create') }}" method="POST" name="form-data" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Tipo de identificacion</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="tip_id" id="tip_id" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                    @foreach ($tipos_identificacion as $tip)
                                        <option value="{{ $tip->tip_id }}">{{ $tip->tip_alias }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="pac_identificacion" class="form-label">Numero de documento</label>
                            <input type="number" class="form-control" id="pac_identificacion" name="pac_identificacion"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_primer_nombre" class="form-label">Primer Nombre</label>
                            <input type="text" class="form-control" id="pac_primer_nombre" name="pac_primer_nombre"
                                onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_segundo_nombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" id="pac_segundo_nombre" name="pac_segundo_nombre"
                                onkeypress="return SoloLetras(event);">
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_primer_apellido" class="form-label">Primer Apellido</label>
                            <input type="text" class="form-control" id="pac_primer_apellido"
                                name="pac_primer_apellido" onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_segundo_apellido" class="form-label">Segundo Apellido</label>
                            <input type="text" class="form-control" id="pac_segundo_apellido"
                                name="pac_segundo_apellido" onkeypress="return SoloLetras(event);">
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_telefono" class="form-label">Telefono</label>
                            <input type="number" class="form-control" id="pac_telefono" name="pac_telefono" required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>
                        <div class="col-3">
                            <label for="pac_fecha_nacimiento" class="form-label">Fecha nacimiento</label>
                            <input type="date" class="form-control" id="pac_fecha_nacimiento"
                                name="pac_fecha_nacimiento" max="<?php echo date("Y-m-d");?>">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Departamento</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="dep_id" id="dep_id" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                    @foreach ($departamentos as $dep)
                                        <option value="{{ $dep->dep_id }}">{{ $dep->dep_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Municipio</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="mun_id" id="mun_id" aria-label="Default select example" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="pac_direccion" name="pac_direccion"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Sexo</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="pac_sexo" id="pac_sexo" aria-label="Default select example" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                    <option class="form-control" value="M">M</option>
                                    <option class="form-control" value="F">F</option>
                                    <option class="form-control" value="Otros">Otros</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Prioridad</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="pro_prioridad" id="pro_prioridad" aria-label="Default select example" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                    <option class="form-control" value="1">1</option>
                                    <option class="form-control" value="2">2</option>
                                    <option class="form-control" value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <label for="pac_regimen_afiliacion_SGSS" class="form-label">Regimen de
                                afiliacion</label>
                            <input type="text" class="form-control" id="pac_regimen_afiliacion_SGSS"
                                name="pac_regimen_afiliacion_SGSS">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary col-3">Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
