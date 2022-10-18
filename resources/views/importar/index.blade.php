@extends('layouts.main')

@section('title')
    Importar
@endsection

<style>

    option:hover {
      background-color: yellow !important;
    }

</style>

@section('content')
    <div class="container-fluid">
        <h1 style="font-weight: bold;">Selecciona el tipo de proceso</h1>
        <div class="select shadow-sm mb-4 align-items-center">
            <select name="format" id="format" style="font-weight: bold;">
                <option selected disabled>Tipo de proceso</option>
                <option value="1" style="color: #000000" class="option">Inasistidos</option>
                <option value="2" style="color: #000000" class="option">Seguimiento demanda inducida</option>
                <option value="3" style="color: #000000" class="option">Recordatorios</option>
                <option value="4" style="color: #000000" class="option">Hospitalizados</option>
                <option value="5" style="color: #000000" class="option">Brigadas</option>
                <option value="6" style="color: #000000" class="option">Reprogramacion</option>
            </select>
        </div>
        <div class="row">
            <div class="col">
                <input type="file" class="form-class border" name="" id="importar" style="width: 640px" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>

            <div class=" col d-flex align-items-center">
                <button type="button" class="btn btn-primary"
                    style="width: 200px; height: 32px; font-weight: bold;">Subir Archivo</button>

            </div>
        </div>
    </div>


    </div>
@endsection
