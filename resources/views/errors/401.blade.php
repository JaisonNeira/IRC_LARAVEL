@extends('errors::minimal')

@section('title', __('Sin permisos'))
@section('code', '401')
@section('message', __('Lo sentimos!, parece que no tiene autorizacion para estar en esta pagina.'))
