@extends('layouts.main')

@section('title')
    Importar
@endsection

@section('script')
<script src="{{ asset('js/funcionalidades/validator.js') }}"></script>
@endsection


@section('content')
    <div class="container" style="width: 55%; align:left;">
        <form name="form_a" onsubmit="return validacion()">
            <h1 style="font-weight: bold;">Selecciona el tipo de proceso</h1>
            <div class="select  col-12 shadow-sm mb-4 align-items-center" id="a">
                <select id="seleccion" style="font-weight: bold;">
                    <option selected disabled>Tipo de proceso</option>
                    <option value="1" style="color: #000000">Inasistidos</option>
                    <option value="2" style="color: #000000">Seguimiento demanda inducida</option>
                    <option value="3" style="color: #000000">Recordatorios</option>
                    <option value="4" style="color: #000000">Hospitalizados</option>
                    <option value="5" style="color: #000000">Brigadas</option>
                    <option value="6" style="color: #000000">Reprogramacion</option>
                </select>
            </div>
            <div class="col-12  mb-4 align-items-center" style="padding-right: 0; padding-left: 0;">
                <input type="file" class="irc-input-file" id="add_archivo"
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <label for="imp" id="validator">
                    <span class="irc-input-file_nombre">
                        <span id="a">Selecciona un archivo</span>
                    </span>
                    <span class="irc-input-file_boton">
                        <i class="fa-solid fa-paperclip text-center m-2" style="font-size: 30px;"></i>
                    </span>
                    <div id="alert1"></div>
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary mt-3"
                    style="width: 200px; height: 48px; font-weight: bold; border: 1px solid  #E22A3D; color: #fff ">Subir
                    Archivo</button>
        </form>
    </div>
@endsection
