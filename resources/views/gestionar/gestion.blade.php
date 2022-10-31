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
                        <div class="col-6">
                            <form action="" class="row">
                                <div class="col-12">
                                    <div class="select select_gestion  col-12  align-items-center">
                                        <select id="seleccion" name="tipo_proceso" style="font-weight: bold;" required>
                                            <option selected disabled>Resultado</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 my-3">
                                    <textarea class="form-control" id="comentario" rows="3" placeholder="Escribe un comentario..."required></textarea>
                                </div>
                                <div class="col-12 px-2 text-right">
                                    <button class="btn btn-primary" type="submit">Enviar Gestion</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-6">

                            <h4>Informacion Personal</h4>
                            <div>
                                <table class="table table-bordered">
                                    <tbody name="info_paciente">

                                    </tbody>
                                </table>
                            </div>
                            <h4>Informacion del proceso</h4>
                            <div>
                                <table class="table table-bordered">
                                    <tbody name="info_proceso">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!-- Historial section -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="text-center">
                                <h4> Hisitorial de Gestiones Hospitalizados</h4>
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
