@extends('layouts.main')

@section('title')
    Importar
@endsection



@section('content')
    <div class="container-md">
        <h1 style="font-weight: bold;">Selecciona el tipo de proceso</h1>
        <div class="select  col-6 shadow-sm mb-4 align-items-center">
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
        <div class="col-12 shadow-sm mb-4 align-items-center">
            <input type="file" class="irc-input-file" id="importar"
                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                required>
            <label for="importar">
                <span class="irc-input-file_nombre">
                    <span>Selecciona un archivo</span>
                </span>
                <span class="irc-input-file_boton">
                    <i class="fa-solid fa-paperclip text-center m-2" style="font-size: 30px;"></i>
                </span>
            </label>
        </div>
        <div>
        <button type="submit" class="btn btn-primary mt-3"
            style="width: 200px; height: 48px; font-weight: bold; border: 1px solid  #E22A3D; color: #fff ">Subir
            Archivo</button>
    </div>
@endsection
