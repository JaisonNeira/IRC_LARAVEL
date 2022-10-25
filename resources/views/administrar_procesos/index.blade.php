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
            <div class="col-12">
                <div class="table-responsive">
                    <table id="table1" class="table table-bordered">
                        <thead style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                            <tr>
                                <th>Fecha de cargue</th>
                                <th>Mes</th>
                                <th>Fecha de Reporte</th>
                                <th>Tipo de Proceso</th>
                                <th>Activo</th>
                                <th>Asignar Agente</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #ffff; text-align: center;">
                            @foreach (variable as $list )
                            <tr>
                                <td>20/02/2022</td>
                                <td>Febrero</td>
                                <td>24/02/2022</td>
                                <td>Hospitalizados</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1" style=""></label>
                                    </div>
                                </td>
                                <td>
                                    @include('administrar_procesos.modal_asignar')
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <table class="table table-primary">
        <thead class="thead-primary">
            <tr>
                <th scope="col">Fecha de cargue</th>
                <th scope="col">Mes</th>
                <th scope="col">Fecha de Reporte</th>
                <th scope="col">Tipo de Proceso</th>
                <th scope="col">Activo</th>
                <th scope="col">Asignar Agente</th>
            </tr>
        </thead>
        <tbody style="background-color: #ffff">
            <td>20/02/2022</td>
            <td>Febrero</td>
            <td>24/02/2022</td>
            <td>Hospitalizados</td>
            <td>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1" style=""></label>
                </div>
            </td>
            <td>
                @include('administrar_procesos.modal_asignar')
            </td>
        </tbody>
    </table>
    --}}
@endsection

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
