@extends('layouts.main')

@section('title')
    Pacientes
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-12">
                    <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#crear_paciente">
                        <i class="fas fa-plus"></i> Nuevo Paciente</button>
                </div>
                <br>
                <div class="table-responsive">

                    @include('layouts.msj')

                    @include('consultar-pacientes.msj')

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
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editar_paciente"
                                            onclick="modal_editar({{ $list->pac_id }});">
                                            <i class="fas fa-edit"></i>
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

    @include('consultar-pacientes.create')

    @include('gestionar.proceso')

    @include('gestionar.perfil')

    @include('consultar-pacientes.edit')

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/funcionalidades/paciente.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
