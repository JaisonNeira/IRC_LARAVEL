@extends('layouts.main')

@section('title')
Crear Rol
@endsection

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Rol</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                    {!! Form::open(array('route' => 'StoreRol','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Rol:</label>
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Permisos para este Rol:</label>
                                <br/>
                                @foreach($permission as $value)
                                    <label class="form-check-label">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
