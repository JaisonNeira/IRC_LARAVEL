@extends('layouts.main')

@section('title')
    Reportes
@endsection


@section('content')
    <div class="row">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-rep-generales" type="button"
                    role="tab" aria-controls="nav-home" aria-selected="true" style="color: red;">REPORTE GENERAL</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-rep-personalizados"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                    style="color: red;">REPORTE PERSONALIZADO</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-Administrar-cargues"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                    style="color: red;">ADMINISTRAR CARGUES</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-rep-generales" role="tabpanel" aria-labelledby="nav-home-tab">
                {{-- REPORTE GENERAL --}}
                @include('reportes.rep_generales')
                {{-- FIN REPORTE GENERAL --}}
            </div>
            <div class="tab-pane fade" id="nav-rep-personalizados" role="tabpanel" aria-labelledby="nav-profile-tab">
                {{-- REPORTE PERSONALIZADO --}}
                @include('reportes.rep_personalizados')
                {{-- FIN REPORTE PERSONALIZADO --}}
            </div>
            <div class="tab-pane fade" id="nav-Administrar-cargues" role="tabpanel" aria-labelledby="nav-profile-tab">
                {{-- REPORTE PERSONALIZADO --}}
                @include('reportes.administar_carg')
                {{-- FIN REPORTE PERSONALIZADO --}}
            </div>
        </div>

    </div>
@endsection
