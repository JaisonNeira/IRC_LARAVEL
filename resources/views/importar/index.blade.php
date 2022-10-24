@extends('layouts.main')

@section('title')
    Importar
@endsection




@section('content')

    <div class="container" style="width: 55%; align:left;">
        {{--  Inicio Formulorio  --}}
        <form action="{{ route('importar.post') }}" method="POST" name="form-data" enctype="multipart/form-data"
            onsubmit="return validacion()">
            @csrf
            <h1 style="font-weight: bold;">Selecciona el tipo de proceso</h1>
            @include('layouts.msj')
            @include('importar.modal_pdf')

            @if (Session::has('import_error'))
                @foreach (Session::get('import_error') as $erros)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> {{ $erros->errors()[0] }} en la linea {{ $erros->row() }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif

            <input type="text" name="file_name" id="file_name" style="display: none;">

            <div class="select  col-12  align-items-center" id="select">
                <select id="seleccion" name="tipo_proceso" style="font-weight: bold;">
                    <option selected disabled>Tipo de proceso</option>
                    @foreach ($tipos_procesos as $list)
                        <option value="{{ $list->tpp_id }}" class="opciones">{{ $list->tpp_nombre }}</option>
                    @endforeach
                </select>
            </div>
            <span class="error" id="error1">Selecciona un proceso</span> {{-- error --}}
            <div class="col-12 mt-4 mb-4 align-items-center" style="padding-right: 0; padding-left: 0;">
                {{-- Input file --}}
                <input type="file" class="irc-input-file" id="add_archivo" name="file"
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <label for="add_archivo">
                    <span class="irc-input-file_nombre" id="validator">
                        <span>Selecciona un archivo</span>
                    </span>
                    <span class="irc-input-file_boton" id="validator2">
                        <i class="fa-solid fa-paperclip text-center m-2" style="font-size: 30px;"></i>
                    </span>
                </label>
                <span class="error" id="error2">Ingresa un archivo</span>{{-- error --}}
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

    <script>
        document.getElementById('add_archivo').onchange = function() {
            $("#file_name").val(document.getElementById('add_archivo').files[0].name);
        }
    </script>
@endsection
