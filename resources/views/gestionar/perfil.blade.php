<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#perfil">
 Perfil
</button>
<div class="modal fade" id="perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar Agentes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table-perfil" class="table table-bordered">
                                <thead style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                    <tr>
                                        <th scope="col">Tipo De Proceso</th>
                                        <th scope="col">Activo</th>
                                        <th scope="col">Mes</th>
                                        <th scope="col">Fecha De Cargue</th>
                                        <th scope="col">Fecha De Reporte</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: #ffff; text-align: center;">
                                    <tr>
                                        <td>Hospitalizados</td>
                                        <td class="fw-bold" style="background-color: rgb(221, 41, 41)">No</td>
                                        <td>Octubre</td>
                                        <td>12/10/2022</td>
                                        <td>20/10/2022</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Asignar agentes</button>
        </div>
      </div>
    </div>
  </div>
