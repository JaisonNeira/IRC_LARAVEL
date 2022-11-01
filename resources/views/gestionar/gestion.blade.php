<div class="modal fade" id="modal_gestion" tabindex="-1" aria-labelledby="gestion-title" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #E22A3D">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-4">
                    <!-- Gestion section -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="text-center">
                                <h4>Informacion Personal</h4>
                            </div>
                            <div>
                                <table class="table table-bordered">
                                    <tbody name="tbody_modal_info_personal">

                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <h4><span id="span_proceso"></span></h4>
                            </div>
                            <div>
                                <table class="table table-bordered">
                                    <tbody name="tbody_modal_info_proceso">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center">
                            <h4>Gestion</h4>
                        </div>
                        <form action="{{ route('gestionar.post') }}" method="POST" name="form-data"
                            enctype="multipart/form-data" class="row">
                            <input type="text" style="display: none;" id="tpp_id" name="tpp_id">
                            <input type="text" style="display: none;" id="pro_id" name="pro_id">
                            <input type="text" style="display: none;" id="pac_id" name="pac_id">
                            <input type="text" style="display: none;" id="usu_id" name="usu_id"
                                value="{{ Auth::user()->id }}">
                            @csrf
                            <div class="col-12">
                                <div class="select select_gestion  col-12  align-items-center">
                                    <select id="seleccion" name="tge_id" style="font-weight: bold;" required>
                                        <option selected disabled>Resultado</option>
                                        @foreach ($tipo_procesos as $list)
                                            <option value="{{ $list->tge_id }}">{{ $list->tge_nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-12" style="display: none;" name="div_input_datetime">
                                <div class="col-12 align-items-center">
                                    <input type="datetime-local" id="fecha_cita" name="fecha_cita">
                                </div>
                            </div>

                            <div class="col-12 my-3">
                                <textarea class="form-control" id="ges_comentario" name="ges_comentario" rows="3"
                                    placeholder="Escribe un comentario..."required></textarea>
                            </div>
                            <div class="col-12 px-2 text-right">
                                <button class="btn btn-primary" type="submit">Enviar Gestion</button>
                            </div>
                        </form>
                    </div>

                    <!-- Historial section -->
                    <div class="row mt-5">
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
