@extends('layouts.main')

@section('title')
    Reportes
@endsection


@section('content')
    <div class="row p-3" style="max-width: 800px">
        {{--  Inicio Formulorio  --}}
        <div class="col-12">
            <h1 style="font-weight: bold;">Generador de reportes</h1>
        </div>

        <div class="col-6 mt-4">
            <div class="select col-12  align-items-center shadow-sm" id="select">
                <select id="seleccion" name="tipo_proceso" style="font-weight: bold;">
                    <option selected disabled>Tipo de proceso</option>
                    {{-- @foreach ($tipos_procesos as $list)
                        <option value="" class="opciones">{{ $list->tpp_nombre }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>


        <div class="col-6 mt-4">
            <div class="select col-12  align-items-center shadow-sm" id="select">
                <select id="seleccion" name="tipo_proceso" style="font-weight: bold;">
                    <option selected disabled>Departamento</option>
                    {{-- @foreach ($tipos_procesos as $list)
                        <option value="" class="opciones">{{ $list->tpp_nombre }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>


        <div class="col-6">
            <div class="row mx-1 mt-4">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="h5" style="min-width: 110px; margin-top: 8px">Fecha Inicio</div>
                </div>
                <div class="col-lg-6 col-md-6  col-sm-12" style="padding-left: 0px; padding-right: 0px;">

                    {{-- ---   Aqui va la fecha Inicio  --- --}}
                    <input type="date" class="form-control" id="rep-fecha-ini" name="rep-fecha-ini"
                        max="<?php echo date('Y-m-d'); ?>" style="font-size: 14px">
                </div>
            </div>
            <div class="col-12">
                <div class="invalid-feedback">Completa los datos</div>
            </div>
        </div>


        <div class="col-6">
            <div class="row mx-1 mt-4">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="h5" style="min-width: 110px; margin-top: 8px">Fecha Fin</div>
                </div>
                <div class="col-lg-6 col-md-6  col-sm-12" style="padding-left: 0px; padding-right: 0px;">

                    {{-- ---   Aqui va la fecha Fin  --- --}}
                    <input type="date" class="form-control" id="rep-fecha-fin" name="rep-fecha-fin"
                        max="<?php echo date('Y-m-d'); ?>" style="font-size: 14px">
                </div>
            </div>
            <div class="col-12">
                <div class="invalid-feedback">Completa los datos</div>
            </div>
        </div>

        <div class="col-12 text-center mt-4">
            <button class="btn btn-primary m-2">Generar pdf</button>
            <button class="btn btn-primary m-2">Generar excel</button>
        </div>

    </div>
@endsection
