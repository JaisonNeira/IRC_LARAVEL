<!-- Modal -->
<div class="modal fade" id="editar_paciente_{{ $list->pro_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#E22A3D;">
                <h4 style="color: #fff; font-wight: bold;">Editar paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pacientes.edit.patch') }}" method="POST" name="form-data" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="row">

                        <input type="text" name="pac_id" id="modal_pac_id" style="display: none;">
                        <input type="text" value="{{Auth::user()->id}}" name="user_id" style="display: none;">

                        <div class="col-6">
                            <label for="pac_telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="modal_pac_telefono" name="pac_telefono" required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-6">
                            <label for="pac_direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" id="modal_pac_direccion" name="pac_direccion"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-6">
                            <label for="pac_direccion" class="form-label">Departamento</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="dep_id" id="modal_dep_id" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="pac_direccion" class="form-label">Municipio</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="mun_id" id="modal_mun_id" aria-label="Default select example" required>
                                    <option class="form-control" disabled selected>-- Seleccione --</option>
                                </select>
                            </div>
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
