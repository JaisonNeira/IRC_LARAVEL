@extends('layouts.main')

@section('title')
    Reportes
@endsection


@section('content')

    <form action="{{ route('reportes.descarga') }}" method="GET" name="form-data" enctype="multipart/form-data">
        @csrf
        <div class="row p-3" {{-- style="max-width: 800px" --}}>
            {{--  Inicio Formulorio  --}}
            <div class="col-12">
                <h1 style="font-weight: bold;">Generador de reportes personalizado</h1>
            </div>

            @include('layouts.msj')

            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <div class="select col-12  align-items-center shadow-sm" id="select">
                    <select id="seleccion" name="tipo_proceso" style="font-weight: bold;" required>
                        <option value="" selected disabled>Tipo de proceso</option>
                        <option value="1">Inasistidos</option>
                        <option value="4">Hospitalizados</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <div class="select col-12  align-items-center shadow-sm" id="select">
                    <select id="seleccion" name="departamento" style="font-weight: bold;" required>
                        <option value="" selected disabled>Departamento</option>
                        <option value="70">SUCRE</option>
                        <option value="23">CORDOBA</option>
                        <option value="50">META</option>
                        {{-- @foreach ($departamentos as $list2)
                            <option value="{{ $list2->dep_id }}" class="opciones">{{ $list2->dep_id }}-{{ $list2->dep_nombre }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row mx-1 mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="h5" style="min-width: 110px; margin-top: 8px">Fecha Inicio</div>
                    </div>
                    <div class="col-lg-9 col-md-9  col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                        {{-- ---   Aqui va la fecha Inicio  --- --}}
                        <input type="date" class="form-control" id="rep_fecha_ini" name="rep_fecha_ini"
                            style="font-size: 14px" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="invalid-feedback">Completa los datos</div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row mx-1 mt-4">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="h5" style="min-width: 110px; margin-top: 8px">Fecha Fin</div>
                    </div>
                    <div class="col-lg-9 col-md-9  col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                        {{-- ---   Aqui va la fecha Fin  --- --}}
                        <input type="date" class="form-control" id="rep_fecha_fin" name="rep_fecha_fin"
                            style="font-size: 14px" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="invalid-feedback">Completa los datos</div>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button types="submit" class="btn btn-primary m-2">Generar</button>
            </div>

        </div>
    </form>
@endsection
