<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Gestion">
    Gestion
</button>

<div class="modal fade" id="Gestion" tabindex="-1" aria-labelledby="gestion-title" aria-hidden="true" role="dialog">
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
                        <div class="col-4">
                            <div class="row">
                                <!-- titulos  gestion -->
                                <div class="col-4">
                                    <h5>Proceso</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Mes</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Cargue</h5>
                                </div>
                                <!-- texto de titulos gestion -->
                                <div class="col-4">
                                    <p>Hospitalizados</p>
                                </div>
                                <div class="col-4">
                                    <p>Marzo</p>
                                </div>
                                <div class="col-4">
                                    <p>10/03/2022</p>
                                </div>
                                <form action="" class="row">
                                    <div class="col-12">
                                        <div class="select select_gestion  col-12  align-items-center">
                                            <select id="seleccion" name="tipo_proceso" style="font-weight: bold;" required>
                                                <option selected disabled>Resultado</option>
                                                <option>Tipo de proceso</option>
                                                <option>Tipo de proceso</option>
                                                <option>Tipo de proceso</option>
                                                <option>Tipo de proceso</option>
                                                <option>Tipo de proceso</option>
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
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <!-- Titulo principal -->
                                <div class="col-12 mb-3">
                                    <h4>Hospitalizados</h4>
                                </div>


                                <!-- Titulos  de arriba -->
                                <div class="col-4">
                                    <h5>Diagnostico</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Fecha de ingreso</h5>
                                </div>
                                <div class="col-4">
                                    <h5>Fecha de egreso</h5>
                                </div>
                                <!--  Texto de Los titulos de arriba -->
                                <div class="col-4">
                                    <p>Un diagnostico</p>
                                </div>
                                <div class="col-4">
                                    <p>23/03/2022</p>
                                </div>
                                <div class="col-4 mb-2">
                                    <p>26/03/2022</p>
                                </div>



                                <!-- Titulos  de abajo -->
                                <div class="col-6">
                                    <h5>Programa</h5>
                                </div>
                                <div class="col-6">
                                    <h5>Es usuario irc?</h5>
                                </div>
                                <!-- Texto de Los titulos de abajo -->
                                <div class="col-6">
                                    <p>Ejemplo</p>
                                </div>
                                <div class="col-6">
                                    <p>Si</p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Historial section -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4> Hisitorial de Gestiones Hospitalizados</h4>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table-gestion" class="table table-bordered">
                                    <thead
                                        style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                        <tr>
                                            <th scope="col">Fecha de gestion</th>
                                            <th scope="col">Gestion</th>
                                            <th scope="col">Agente</th>
                                            <th scope="col">Resultado</th>
                                            <th scope="col">Comentarios</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #ffff; text-align: center;">
                                        <tr>
                                            <td>23/02/2022</td>
                                            <td> - </td>
                                            <td>Jhon</td>
                                            <td>No contestó</td>
                                            <td> Agendado </td>
                                        </tr>
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
