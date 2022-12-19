@extends('layouts.main')

@section('title')
    Gestionamiento
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
                                <th style="text-align: center;">Mes</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Proceso</th>
                                <th style="text-align: center;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #ffff; text-align: center;">
                            @foreach ($cargues as $list)
                                <tr>
                                    <td>{{ $list->car_mes }}</td>
                                    <td>{{ $list->Acc_nombre }}</td>
                                    <td>{{ $list->tpp_nombre }}</td>
                                    <td>
                                        @switch($list->tpp_id)
                                            @case('1')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.ina', $list->car_id, ) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('2')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.seg', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('3')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.rec', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('4')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.hos', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('5')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.bri', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('6')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.rep', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @case('7')
                                                <a class="btn btn-primary"
                                                    href="{{ route('gestionamiento.e.cap', $list->car_id) }}">
                                                    <i class="far fa-eye"></i></a>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
