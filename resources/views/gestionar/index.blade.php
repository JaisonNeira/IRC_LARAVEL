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
            <div class="table-responsive">
                <table id="table3" class="table table-bordered">
                    <thead style="background-color: #E22A3D; color:#ffff; text-align:center;">
                        <tr>
                            <th style="text-align: center;">Prioridad</th>
                            <th style="text-align: center;">Nombre</th>
                            <th style="text-align: center;">Apellido</th>
                            <th style="text-align: center;">Teléfono</th>
                            <th style="text-align: center;">Operación</th>
                            <th style="text-align: center;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffff; text-align: center;">
                        <tr>
                            <td> <p style="display: none;">1</p><i class="fa-solid fa-circle circle"></i></td>
                            <td>1</td>
                            <td>Ramirez</td>
                            <td>301013</td>
                            <td>Hospitalizados</td>
                            <td><button class="btn btn-primary"></button> <button class="btn btn-primary"></button> <button class="btn btn-primary"></button></td>
                        </tr>
                        <tr>
                            <td> <p style="display: none;">3</p><i class="fa-solid fa-circle s" style="background-color:#fff "></i></td>
                            <td>3</td>
                            <td>Ramirez</td>
                            <td>301013</td>
                            <td>Hospitalizados</td>
                            <td><button class="btn btn-primary"></button> <button class="btn btn-primary"></button> <button class="btn btn-primary"></button></td>
                        </tr>
                        <tr>
                            <td> <p style="display: none;">2</p><i class="fa-solid fa-circle circle"></i></td>
                            <td>2</td>
                            <td>Ramirez</td>
                            <td>301013</td>
                            <td>Hospitalizados</td>
                            <td><button class="btn btn-primary"></button> <button class="btn btn-primary"></button> <button class="btn btn-primary"></button></td>
                        </tr>
                        <tr>
                            <td> <p style="display: none;">2</p><i class="fa-solid fa-circle circle"></i></td>
                            <td>2</td>
                            <td>Ramirez</td>
                            <td>301013</td>
                            <td>Hospitalizados</td>
                            <td><button class="btn btn-primary"></button> <button class="btn btn-primary"></button> <button class="btn btn-primary"></button></td>
                        </tr>
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
