@extends('layouts.main')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid text-center">
        <div class="container  shadow-lg text-center bg-img-color rounded" style="min-height: 500px;">
            <div class="row">
                <div class="col-6 text-left p-2">
                    <img src="{{ asset('img/irc_icon_white.png') }}" alt=""
                        style="max-width: 200px; max-height: 35px;">
                </div>
                <div class="col-6 text-right p-2">
                    <img src="{{ asset('img/contacta_white.png') }}" alt=""
                        style="max-width: 200px; max-height: 40px;">
                </div>

                <div class="col-12 text-center text-white">
                    <h1 style="font-weight: bold;" class="">Bienvenido a IRC</h1>
                    <h3 style="font-weight: bold;" class="">{{ Auth::user()->name }}</h3>
                </div>

                <div class="col-12 px-5" style="margin-top: 90px">
                    <div class="text-left text-white">
                        <h3>Panel informativo</h3>
                        <p>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                          - Probando informacion de test.<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
