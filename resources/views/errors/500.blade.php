@extends('errors::minimal')

@section('title', __('Error del servidor'))
@section('code', '500')
@section('message', __('Lo sentimos!, parece que ha habido un error en el servidor.'))
