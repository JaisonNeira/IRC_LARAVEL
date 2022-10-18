<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
    <i class="fa-solid fa-person-circle-plus text-center" style="font-size: 20px;"></i>
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar Agentes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-primary">
                <!--  Tabla  -->
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">Identificacion</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Asignar</th>
                    </tr>
                </thead>
                <tbody style="background-color: #ffff">
                    <td>1042241113</td>
                    <td>Jaison</td>
                    <td>Neira</td>
                    <td>
                        <input type="checkbox" id="cbox1" value="first_checkbox">
                    </td>
                </tbody>
            </table>
            <!--  fin Tabla  -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Asignar agentes</button>
        </div>
      </div>
    </div>
  </div>
