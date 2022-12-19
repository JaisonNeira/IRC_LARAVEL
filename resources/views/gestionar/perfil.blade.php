<div class="modal fade" id="modal_perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #E22A3D">
                <h4 class="text-white">Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">


                    <div class="row">
                        <!-- Titulo -->
                        <div class="col-12 pt-3 pb-4 text-center">
                            <h3>Informacion del paciente</h3>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <!-- Titulos -->
                        <div class="col-3  text-center title">
                            <h5 class="title">Tipo de documento</h5>
                            <label class="texto" for="" id="perfil_tipo_documento"></label>
                        </div>
                        <div class="col-3  text-center title">
                            <h5 class="title">Numero de documento</h5>
                            <label class="texto" for="" id="perfil_numero_documento"></label>
                        </div>
                        <div class="col-3  text-center title">
                            <h5 class="title">Nombre completo</h5>
                            <label class="texto" for="" id="perfil_nombre"></label>
                        </div>
                        <div class="col-3  text-center">
                            <h5 class="title">Teléfono</h5>
                            <label class="texto" for="" id="perfil_telefono"></label>
                        </div>
                        <div class="col-3  text-center title">
                            <h5 class="title">Sexo</h5>
                            <label class="texto" for="" id="perfil_sexo"></label>
                        </div>
                        <div class="col-3  text-center">
                            <h5 class="title">Fecha de nacimineto</h5>
                            <label class="texto" for="" id="perfil_nacimiento"></label>
                        </div>
                        {{-- <div class="col-3  text-center">
                            <h5 class="title">Correo electronico</h5>
                            <label class="texto" for="" id="perfil_correo"></label>
                        </div> --}}
                        <div class="col-3  text-center">
                            <h5 class="title">Direccion</h5>
                            <label class="texto" for="" id="perfil_direccion"></label>
                        </div>
                        <div class="col-3  text-center">
                            <h5 class="title">Departamento</h5>
                            <label class="texto" for="" id="perfil_departamento"></label>
                        </div>
                        <div class="col-3  text-center">
                            <h5 class="title">Municipio</h5>
                            <label class="texto" for="" id="perfil_municipio"></label>
                        </div>
                        <div class="col-3  text-center">
                            <h5 class="title">Afiliacion al SGSS</h5>
                            <label class="texto" for="" id="perfil_afiliado"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pb-5">
                            <div class="text-center">
                                <h4>Historial de gestiones</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="table-perfil" class="table table-bordered">
                                    <thead
                                        style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                        <tr>
                                            <th scope="col text-center">Proceso</th>
                                            <th scope="col text-center">Mes</th>
                                            <th scope="col text-center">Fecha de cargue</th>
                                            <th scope="col text-center">Fecha de gestion</th>
                                            <th scope="col text-center">Agente</th>
                                            <th scope="col text-center">Resultado</th>
                                            <th scope="col text-center">Comentarios</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #ffff; text-align: center;"
                                        name="tbody_modal_perfil">

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
