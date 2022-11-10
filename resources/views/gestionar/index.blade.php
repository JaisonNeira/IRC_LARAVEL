@extends('layouts.main')

@section('title')
    Gestionar
@endsection

@section('style')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('layouts.msj')
                <div class="table-responsive">
                    <table id="table3" class="table table-bordered">
                        <thead style="background-color: #E22A3D; color:#ffff; text-align:center;">
                            <tr>
                                <th style="text-align: center;">Prioridad</th>
                                <th style="text-align: center;">documento</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Teléfono</th>
                                <th style="text-align: center;">Operación</th>
                                <th style="text-align: center;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #ffff; text-align: center;">
                            @foreach ($gestiones as $gestion)
                                <tr onload="prioridad({{ $gestion->pro_id }})">
                                    <!-- Esta es la variable -->
                                    <td>
                                        @if ($gestion->pro_prioridad == 1)
                                            <!-- Si es prioridad 1 -->
                                            <span style="display: none;">1</span>
                                            <i class="fa-solid fa-circle circle-red"
                                                id="pri_red_{{ $gestion->pro_id }}"></i>
                                        @endif
                                        @if ($gestion->pro_prioridad == 2)
                                            <!-- Si es prioridad 2 -->
                                            <span style="display: none;">2</span>
                                            <i class="fa-solid fa-circle circle-yellow"
                                                id="pri_yellow_{{ $gestion->pro_id }}"></i>
                                        @endif
                                        @if ($gestion->pro_prioridad == 3)
                                            <!-- Si es prioridad 3 -->
                                            <span style="display: none;">3</span>
                                            <i class="fa-solid fa-circle circle-green"
                                                id="pri_green_{{ $gestion->pro_id }}"></i>
                                        @endif
                                    </td>
                                    <td>{{ $gestion->pac_identificacion }}</td>
                                    <td>{{ $gestion->pac_primer_nombre }} {{ $gestion->pac_segundo_nombre }}
                                        {{ $gestion->pac_primer_apellido }} {{ $gestion->pac_segundo_apellido }}</td>
                                    <td>{{ $gestion->pac_telefono }}</td>
                                    <td>{{ $gestion->tpp_nombre }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal_proceso" onclick="modal_proceso({{ $gestion->pac_id }});">
                                            Proceso
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal_perfil" onclick="modal_perfil({{ $gestion->pac_id }});">
                                            Perfil
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal_gestion"
                                            onclick="modal_gestion({{ $gestion->pro_id }}, {{ $gestion->tpp_id }}, {{ $gestion->pac_id }});">
                                            Gestion
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

    @include('gestionar.proceso')

    @include('gestionar.perfil')

    @include('gestionar.gestion')
@endsection

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
