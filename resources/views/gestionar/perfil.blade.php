@foreach ($gestiones as $perfil )
<div class="modal fade" id="perfil_{{$perfil->pro_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #E22A3D">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">


                    <div class="row">
                        <!-- Titulo -->
                        <div class="col-12 pt-3 pb-5">
                            <h3>Informacion del paciente</h3>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <!-- Titulos -->
                        <div class="col-3 title">
                            <h5>Nombre completo</h5>
                        </div>
                        <div class="col-3 title">
                            <h5> Numero de documento</h5>
                        </div>
                        <div class="col-3 title">
                            <h5>Tipo de documento</h5>
                        </div>
                        <div class="col-3 title">
                            <h5>Sexo</h5>
                        </div>

                        <!-- Variables de los titulos primera fila -->

                        <!-- Nombre completo -->
                        <div class="col-3">
                            {{-- <p>{{$perfil->nombre}}</p> --}}
                        </div>
                        <!-- Numero de documento -->
                        <div class="col-3">
                            {{-- <p>{{$perfil->identificacion}}</p> --}}
                        </div>
                        <!-- Tipo de documento -->
                        <div class="col-3">

                            {{-- <p>{{$perfil->tipo_identificacion}}</p> --}}
                        </div>
                        <!-- Sexo -->
                        <div class="col-3">

                            {{-- <p>{{$perfil->sexo}}</p> --}}
                        </div>
                    </div>


                    <div class="row pb-4">
                        <!-- Titulos -->
                        <div class="col-3">
                            <h5>Teléfono</h5>
                        </div>
                        <div class="col-3">
                            <h5> Fecha de nacimineto</h5>
                        </div>
                        <div class="col-3">
                            <h5>Correo electronico</h5>
                        </div>
                        <div class="col-3">
                            <h5>Direccion</h5>
                        </div>

                        <!-- Variables de los titulos segunda fila -->
                        <div class="col-3">
                            <!-- Teléfono -->
                            {{-- <p>{{$perfil->telefono}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Fecha de nacimineto -->
                            {{-- <p>{{$perfil->fecha_nacimiento}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Correo electronico -->
                            {{-- <p>{{$perfil->correo}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Direccion -->
                            {{-- <p>{{$perfil->direccion}}</p> --}}
                        </div>
                    </div>


                    <div class="row pb-4">
                        <!-- Titulos -->
                        <div class="col-3">
                            <h5>Departamento</h5>
                        </div>
                        <div class="col-3">
                            <h5>Municipio</h5>
                        </div>
                        <div class="col-3">
                            <h5>Afiliacion al SGSS</h5>
                        </div>
                        <div class="col-3">
                            <h5></h5>
                        </div>

                        <!-- Variables de los titulos segunda fila -->
                        <div class="col-3">
                            <!-- Departamento -->
                            {{-- <p>{{$perfil->dep}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Municipio -->
                            {{-- <p>{{$perfil->mun}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Afiliacion -->
                            {{-- <p>{{$perfil->afil}}</p> --}}
                        </div>
                        <div class="col-3">
                            <!-- Campo vacio -->
                            <p></p>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-12 pt-5 pb-2"><h4>Historial de gestiones</h4></div>
                        <div class="col-12 pb-5">
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
                                    <tbody style="background-color: #ffff; text-align: center;">
                                        {{-- @foreach ($gestiones as $gestion_historial) --}}
                                            <tr>
                                                <!-- Variables de tabla -->
                                                {{-- <td>{{$gestion_historial->tpp_prcoeso}}</td>
                                                <td>{{$gestion_historial->mes}}</td>
                                                <td>{{$gestion_historial->fecha_cargue}}</td>
                                                <td>{{$gestion_historial->fecha_gestion}}</td>
                                                <td>{{$gestion_historial->agente}}</td>
                                                <td>{{$gestion_historial->resultado}}</td>
                                                <td>{{$gestion_historial->comentario}}</td> --}}
                                            </tr>
                                        {{-- @endforeach --}}
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
@endforeach
