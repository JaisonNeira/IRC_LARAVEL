@extends('layouts.main')

@section('title')
    Excel-REP
@endsection

@section('content')
<div class="ccontainer-fluid">
    <div class="table-responsive-xl">
        <table class="table" id="table_rep">
            <thead>
                <tr>
                    <th scope="col">Documento</th>
                    <th scope="col">Numero de Documento</th>
                    <th scope="col">Primer Nombre</th>
                    <th scope="col">Segundo Nombre</th>
                    <th scope="col">Primer apellido</th>
                    <th scope="col">Segundo apellido</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Regimen de afiliacion SGSS</th>
                    <th scope="col">Fecha de Reporte</th>
                    <th scope="col">Mes</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Fecha cita</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Medico</th>
                    <th scope="col">Convenio</th>
                </tr>
            </thead>
            <tbody name="tbody_excel_rep">
            </tbody>
        </table>
    </div>
</div>

@endsection
