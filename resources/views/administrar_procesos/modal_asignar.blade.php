<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <i class="fa-solid fa-person-circle-plus text-center" style="font-size: 20px;"></i>
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#E22A3D;">
                <h4 style="color: #fff; font-wight: bold;">Asignar Agente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-2" style="text-align: left">
                            <h5>Escoge el tipo de segmentacion</h5>
                        </div>

                            <div class="d-flex flex-row ml-3">
                                <div class="flex-column">
                                    {{-- select programa  --}}
                                       <select class="custom-select" id="programa">
                                           <option selected disabled>Programa</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
                                    
                                   {{-- select convenio --}}
                                   <div class="flex-column">
                                       <select class="custom-select" id="convenio">
                                           <option selected disabled>Convenio</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
       
                                   {{-- select departamento --}}
                                   <div class="flex-column">
                                       <select class="custom-select" id="departamento">
                                           <option selected disabled>Departamento</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
                                   <div class="flex-column">
                                   {{-- select especialidad --}}
                                       <select class="custom-select" id="especialidad">
                                           <option selected disabled>Especialidad</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
                                   {{-- select Municipio --}}
                                   <div class="flex-column">
                                       <select class="custom-select" id="municipio">
                                           <option selected disabled>Municipio</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
                                    {{-- select punto de acopio --}}
                                   <div class="flex-column">
                                       <select class="custom-select" id="punto_de_acopio">
                                           <option selected disabled>Punto de acopio</option>
                                           <option value="1">One</option>
                                       </select>
                                   </div>
                            </div>

                        <div class="col-12 mt-3">
                            <div class="table-responsive">
                                <table id="table2" class="table table-bordered">
                                    <thead
                                        style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                        <tr>
                                            <th scope="col">Identificacion</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Asignar</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #ffff; text-align: center;">
                                        <tr>
                                            <td>1042241113</td>
                                            <td>Jaison</td>
                                            <td>Neira</td>
                                            <td>
                                                <input type="checkbox" id="cbox1" value="first_checkbox">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary">Asignar agentes</button>
            </div>
        </div>
    </div>
</div>
