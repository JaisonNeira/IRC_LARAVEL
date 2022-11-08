@extends('layouts.main')

@section('title')
    Captaciones
@endsection

@section('content')
    <main>
        <div class="">
            <h3>Captaciones del mes de </h3>

            @include('layouts.msj')

            <div class="table-responsive">
                <table id="tabla_captaciones" class="table table-bordered">
                    <thead style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                        <tr>
                            <th>Prioridad</th>
                            <th>Identificacion</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffff; text-align: center;" id="registros" name="registros">
                        @foreach ($procesos as $list)
                            <tr onload="prioridad({{ $list->pro_id }})">
                                <!-- Esta es la variable -->
                                <td>
                                    @if ($list->pro_prioridad == 1)
                                        <!-- Si es prioridad 1 -->
                                        <span style="display: none;">1</span>
                                        <i class="fa-solid fa-circle circle-red" id="pri_red_{{ $list->pro_id }}"></i>
                                    @endif
                                    @if ($list->pro_prioridad == 2)
                                        <!-- Si es prioridad 2 -->
                                        <span style="display: none;">2</span>
                                        <i class="fa-solid fa-circle circle-yellow" id="pri_yellow_{{ $list->pro_id }}"></i>
                                    @endif
                                    @if ($list->pro_prioridad == 3)
                                        <!-- Si es prioridad 3 -->
                                        <span style="display: none;">3</span>
                                        <i class="fa-solid fa-circle circle-green" id="pri_green_{{ $list->pro_id }}"></i>
                                    @endif
                                </td>
                                <td>{{ $list->pac_identificacion }}</td>
                                <td>{{ $list->pac_primer_nombre }} {{ $list->pac_segundo_nombre }}
                                    {{ $list->pac_primer_apellido }} {{ $list->pac_segundo_apellido }}</td>
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
                                        data-target="#modal_asignar_{{$list->pro_id}}">
                                        Asignar
                                    </button>

                                </td>
                            </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('gestionar.proceso')

    @include('gestionar.perfil')

    @include('captaciones.modal_asignar')

@endsection

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#tabla_captaciones').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>
@endsection
