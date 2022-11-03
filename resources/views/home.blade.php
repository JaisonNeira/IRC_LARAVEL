@extends('layouts.main')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid text-center">
        <div class="container  shadow-lg text-center bg-img-color rounded" style="min-height: 500px;">
            <div class="row">
                <div class="col-6 text-left p-2">
                    <img src="{{ asset('img/irc_icon_white.png') }}" alt="" style="max-width: 200px; max-height: 35px;">
                </div>
                <div class="col-6 text-right p-2">
                    <img src="{{ asset('img/contacta_white.png') }}" alt="" style="max-width: 200px; max-height: 40px;">
                </div>
        
                <div class="col-12 text-center text-white pt-5 mt-5">
                    <h1 style="font-weight: bold;" class="pt-5">Bienvenido a IRC</h1>
                    <h3 style="font-weight: bold;" class="">{{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
