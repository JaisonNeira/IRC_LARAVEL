@extends('layouts.main')

@section('title')
Pacientes
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#crear_paciente">
                <i class="fas fa-plus"></i> Nuevo Paciente</button>
            <div class="table-responsive">
                <table id="table3" class="table table-bordered">
                    <thead style="background-color: #E22A3D; color:#ffff; text-align:center;">
                        <tr>
                            <th style="text-align: center;">identificacion</th>
                            <th style="text-align: center;">Nombre</th>
                            <th style="text-align: center;">Teléfono</th>
                            <th style="text-align: center;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffff; text-align: center;">
                        @foreach ($pacientes as $list)
                        <tr onload="prioridad({{ $list->pro_id }})">
                            <!-- Esta es la variable -->
                            <td>{{ $list->pac_identificacion }}</td>
                            <td>{{ $list->pac_primer_nombre }} {{ $list->pac_primer_apellido }}</td>
                            <td>{{ $list->pac_telefono }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal_proceso" onclick="modal_proceso({{ $list->pac_id }});">
                                    Proceso
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal_perfil" onclick="modal_perfil({{ $list->pac_id }});">
                                    Perfil
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="crear_paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-3">
                            <label for="pac_identificacion" class="form-label">Numero de documento</label>
                            <input type="number" class="form-control" id="pac_identificacion" name="pac_identificacion"
                                required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_primer_nombre" class="form-label">Primer Nombre</label>
                            <input type="text" class="form-control" id="pac_primer_nombre" name="pac_primer_nombre"
                                onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_segundo_nombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" id="pac_segundo_nombre" name="pac_segundo_nombre"
                                onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_primer_apellido" class="form-label">Primer Apellido</label>
                            <input type="text" class="form-control" id="pac_primer_apellido" name="pac_primer_apellido"
                                onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_segundo_apellido" class="form-label">Segundo Apellido</label>
                            <input type="text" class="form-control" id="pac_segundo_apellido"
                                name="pac_segundo_apellido" onkeypress="return SoloLetras(event);" required>
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-3">
                            <label for="pac_telefono" class="form-label">Telefono</label>
                            <input type="number" class="form-control" id="pac_telefono" name="pac_telefono" required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>
                        <div class="col-3">
                            <label for="pac_fecha_nacimiento" class="form-label">Fecha nacimiento</label>
                            <input type="date" class="form-control" id="pac_fecha_nacimiento"
                                name="pac_fecha_nacimiento" required>
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-3">
                            <label for="pac_direccion" class="form-label">Departamento</label>
                            <div class="col-12 select shadow-sm" style="max-height:38px">
                                <select name="dep_id" id="dep_id">
                                    <option class="form-control" disabled selected>Departamento</option>
                                    @foreach ($departamentos as $dep)
                                    <option value="{{ $dep->CAR_ID }}">{{ $dep->CAR_NOMBRE }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <label for="pac_direccion" class="form-label">Municipio</label>
                                <div class="col-12 select shadow-sm" style="max-height:38px">
                                    <select name="mun_id" id="mun_id" {{-- class="form-select" --}}
                                        aria-label="Default select example" required>
                                        <option class="form-control" disabled selected>Municipio</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <label for="pac_direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="pac_direccion" name="pac_direccion"
                                    required>
                                <div class="invalid-feedback">Completa los datos</div>
                                <br>
                            </div>

                            <div class="col-3">
                                <label for="pac_direccion" class="form-label">Sexo</label>
                                <div class="col-12 select shadow-sm" style="max-height:38px">
                                    <select name="pac_sexo" id="pac_sexo" {{-- class="form-select" --}}
                                        aria-label="Default select example" required>
                                        <option class="form-control" disabled selected>-- Seleccione --</option>
                                        <option class="form-control" value="M">M</option>
                                        <option class="form-control" value="F">F</option>
                                        <option class="form-control" value="Otros">Otros</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <label for="pac_regimen_afiliacion_SGSS" class="form-label">Regimen de
                                    afiliacion</label>
                                <input type="number" class="form-control" id="pac_regimen_afiliacion_SGSS"
                                    name="pac_regimen_afiliacion_SGSS" required>
                                <div class="invalid-feedback">Completa los datos</div>
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

@include('gestionar.proceso')

@include('gestionar.perfil')
@endsection

@section('script')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection