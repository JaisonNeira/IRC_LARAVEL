<div class="modal fade" id="modal_gestion" tabindex="-1" aria-labelledby="gestion-title" aria-hidden="true" role="dialog"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #E22A3D">
                <h4 class="text-white">Gestionar paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="desactivar()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container pl-4 pr-4">
                    {{-- gestion --}}

                    <div class="contanier-fluid mt-2 p-3">
                        <div class="row mb-4">
                            {{-- Gestion e informacion --}}
                            <div class="col-6 p-3">
                                {{-- Tabla de Informacion del Usuario --}}
                                <div class="col-12">
                                    <h4 class="text-center mb-3">Gestion</h4>
                                </div>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <td class="text-center bold">Documento</td>
                                            <td class="text-center bold">Nombre Completo</td>
                                            <td class="text-center bold">Telefono</td>
                                        </tr>
                                    </thead>
                                    <tbody name="tbody_modal_info_personal">
                                    </tbody>
                                </table>
                                {{-- Formulario --}}
                                <form action="{{ route('gestionar.post') }}" method="POST" name="form-data"
                                    enctype="multipart/form-data" class="row mb-4">
                                    <input type="text" style="display: none;" id="tpp_id" name="tpp_id">
                                    <input type="text" style="display: none;" id="pro_id" name="pro_id">
                                    <input type="text" style="display: none;" id="pac_id" name="pac_id">
                                    <input type="text" style="display: none;" id="usu_id" name="usu_id"
                                        value="{{ Auth::user()->id }}">
                                    @csrf
                                    <div class="col-12 mb-3" style="padding-left:0px, max-width: 495PX !important;">
                                        <h6>Resultado</h6>
                                        <div class="select select_gestion  col-12  align-items-center">
                                            <select id="seleccion" name="tge_id" style="font-weight: bold;" required>
                                                <option selected disabled>Selecionar Resultado</option>
                                                @foreach ($tipo_procesos as $list)
                                                    <option value="{{ $list->tge_id }}">{{ $list->tge_nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 col_style" {{-- style="display: none;" --}} name="div_input_datetime">
                                        <h6>Fecha de la Nueva Cita</h6>
                                        <input type="datetime-local" id="fecha_cita" name="fecha_cita">
                                    </div>




                                    <div class="col-12 my-3">
                                        <textarea class="form-control" id="ges_comentario" name="ges_comentario" rows="3" style="max-width: 985px"
                                            placeholder="Escribe un comentario..."required></textarea>
                                    </div>
                                    <div class="col-12  text-right mt-">
                                        <button class="btn btn-primary" type="submit">Enviar Gestion</button>
                                    </div>
                                </form>
                            </div>


                             {{-- Informacion del proceso --}}
                            <div class="col-6 p-3">
                                <div class="text-center">
                                    <h4 class="mb-3"><span id="span_proceso"></span></h4>
                                </div>
                                <!-- Informacion info proceso -->
                                <table class="table table-responsive" name="tbody_modal_info_proceso">
                                </table>
                                <div class="container-fluid p-3 text-center" style="margin-top: 122px !important;">
                                    <button class="btn  btn_ver_mas" onclick="activar()">
                                        <p id="texto_ver" style="margin-bottom: 0px">Ver Historial</p>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Historial gestion proceso -->
                    <div class="container-fluid" style="display: none" id="historial">
                        <div class="row mt-2 py-2">
                            <div class="col-12">
                                <div class="text-center">
                                    <h4> Historial de Gestiones</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="table-gestion" class="table table-bordered">
                                        <thead
                                            style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                            <tr>
                                                <th scope="col">Fecha de gestion</th>
                                                <th scope="col">Agente</th>
                                                <th scope="col">Resultado</th>
                                                <th scope="col">Comentarios</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: #ffff; text-align: center;"
                                            name="tbody_modal_gestion">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
