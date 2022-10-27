@extends('layouts.main')

@section('title')
    Administrar Procesos
@endsection
@section('style')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2" style="text-align: left">
                <h5>Escoge el tipo de segmentacion</h5>
            </div>
            @php
                use app\models\departamento;
                use Illuminate\Support\Facades\DB;

                $sql =
                    "SELECT dep.dep_id, dep.dep_nombre
                                    FROM procesos AS pro
                                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                                    INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                                    WHERE pro.pro_estado = 1
                                    AND pro.car_id = " .
                    $list->car_id .
                    "
                                    GROUP BY dep.dep_id, dep.dep_nombre";
                $departamentos = DB::select($sql);
            @endphp

            <div class="d-flex flex-row ml-3">

                {{-- select departamento --}}
                <div class="flex-column">
                    <select class="custom-select" id="departamento" required>

                        <option class="form-control" selected disabled>-- Seleccione --</option>
                        @foreach ($departamentos as $dep)
                            <option value="{{ $dep->dep_id }}">{{ $dep->dep_nombre }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="flex-column">
                    {{-- select convenio  --}}
                    <select class="custom-select" id="convenio">

                    </select>
                </div>

                <div class="flex-column">
                    {{-- select programa  --}}
                    <select class="custom-select" id="programa">

                    </select>
                </div>

                <div class="flex-column">
                    {{-- select especialidad --}}
                    <select class="custom-select" id="especialidad">

                    </select>
                </div>

                {{-- select Municipio --}}
                <div class="flex-column">
                    <select class="custom-select" id="municipio">

                    </select>
                </div>

                {{-- select punto de acopio --}}
                <div class="flex-column">
                    <select class="custom-select" id="punto_de_acopio">

                    </select>
                </div>
                {{-- select punto de acopio --}}
                <div class="flex-column">
                    <select class="custom-select" id="punto_de_acopio">

                    </select>
                </div>
            </div>
            <h2>pan de {{ $list->car_id }}</h2>
            <table id="table2" class="table table-bordered">
                <thead style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                    <tr>
                        <th>Identificacion</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Asignar</th>
                    </tr>
                </thead>
                <tbody style="background-color: #ffff; text-align: center;" id="registros_asignar" name="registros_asignar">

                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
