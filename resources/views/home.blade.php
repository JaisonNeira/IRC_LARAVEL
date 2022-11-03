@extends('layouts.main')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid text-center" >
        <div class="container shadow-lg text-center bg-img-color rounded" style="min-height: 500px;">
           
            <div class="text-left text-white">
                <h1 style="font-weight: bold;" class="p-5">Bienvenido, {{ Auth::user()->name }} </h1>
            </div>
        </div>
    </div>
@endsection
