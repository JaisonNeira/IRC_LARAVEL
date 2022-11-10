@extends('layouts.main')

@section('title')
    Centro de Ayuda
@endsection

@section('style')
@endsection



@section('content')
    <div class="row d-flex rounded">

        <div class="row  mr-3 ml-3 mb-3 ">
        {{-- - Comienzo Manuales --}}
        <div class="col-12">
            <div class="container m-2  rounded pb-3" style="padding-left: 300px; padding-right: 300px;">
                <h3 class="text-center">Manuales de Usuario</h3>
                <div class="row g-2 m-2 pt-2">
                    <div class="col-4">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                            </div>
                            <p>Manual <br>Administrador IRC</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                            </div>
                            <p>Manual <br>Agentes</p>
                        </a>
                    </div>
                    <div class="col-4">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                            </div>
                            <p>Manual <br>Supervisor</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin Manuales --}}

        {{-- Comienzo Plantillas --}}
        <div class="col-6">
            <div class="container  m-2 py-3 rounded">
                <h3 class="text-center">Plantillas</h3>
                <div class="row m-2 pt-2">
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>
                    <div class="col-3">
                        <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                            <div class="text-center">
                                <i class="fa-solid fa-file-excel" style="font-size:20px"></i>
                            </div>
                            <p>Plantilla <br>Captacion</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        {{-- fin Plantillas --}}

        <div class="col-6">
            <div class="row">
                <div class="col-12 py-3">
                    <h3 class="text-center">Manuales de Plantillas</h3>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Inasistidos</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Seguimiento</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Recordatorios</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Hospitalizados</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Brigadas</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Reprogramacion</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-center custom-link" href="{{-- Aqui va el link --}}" style="font-size: 10px;">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf" style="font-size:20px"></i>
                        </div>
                        <p>Manual <br>Captacion</p>
                    </a>
                </div>
                <div class="col-3">

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection




@section('script')
@endsection
