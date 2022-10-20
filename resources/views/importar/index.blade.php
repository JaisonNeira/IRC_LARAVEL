@extends('layouts.main')

@section('title')
    Importar
@endsection




@section('content')
    <div class="container" style="width: 55%; align:left;">
        {{--  Inicio Formulorio  --}}
        <form name="form" onsubmit="return validacion()">
            <h1 style="font-weight: bold;">Selecciona el tipo de proceso</h1>
            <div class="select  col-12  align-items-center" id="select">
                <select id="seleccion" style="font-weight: bold;">
                    <option selected disabled>Tipo de proceso</option>
                    <option value="1" class="opciones">Inasistidos</option>
                    <option value="2" class="opciones">Seguimiento demanda inducida</option>
                    <option value="3" class="opciones">Recordatorios</option>
                    <option value="4" class="opciones">Hospitalizados</option>
                    <option value="5" class="opciones">Brigadas</option>
                    <option value="6" class="opciones">Reprogramacion</option>
                </select>
            </div>
            <span class="error" id="error1">Selecciona un proceso</span> {{--error--}}
            <div class="col-12 mt-4 mb-4 align-items-center" style="padding-right: 0; padding-left: 0;">
                {{-- Input file --}}
                <input type="file" class="irc-input-file" id="add_archivo" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <label for="add_archivo">
                    <span class="irc-input-file_nombre" id="validator">
                        <span>Selecciona un archivo</span>
                    </span>
                    <span class="irc-input-file_boton" id="validator2">
                        <i class="fa-solid fa-paperclip text-center m-2" style="font-size: 30px;"></i>
                    </span>
                </label>
                <span class="error" id="error2">Ingresa un archivo</span>{{--error--}}
            </div>
            <div>
            <button type="submit" class="btn btn-primary mt-3"
            style="width: 200px; height: 48px; font-weight: bold; border: 1px solid  #E22A3D; color: #fff ">Subir
            Archivo</button>
        </form>
          {{--  Fin Formulorio  --}}
    </div>
@endsection

@section('script')
<script src="{{ asset('js/funcionalidades/validator.js') }}"></script>
@endsection