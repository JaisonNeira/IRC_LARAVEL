@extends('layouts.auth_app')

@section('title')
    Asignar
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Asignar</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Usuario:</label>

                                        {{-- Usuarios --}}
                                        {!! Form::open(array('route' => 'Asignar','method'=>'POST')) !!}
                                        <select name="model_id"
                                            id="model_id" class="form-select"
                                            aria-label="Default select example" required>
                                            <option value=""></option>
                                            @foreach ($users as $list)
                                                <option value="{{ $list->id }}">
                                                    {{ $list->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Asignar a:</label>
                                        <br />

                                        {{-- selecciones --}}
                                        <div class="container">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                      Regionales
                                                    </button>
                                                  </h2>
                                                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @foreach($regional as $value)
                                                        <label class="form-check-label">{{ Form::checkbox('regionales[]', $value->id, false, array('class' => 'tbl_regionals_nombre')) }}
                                                        {{ $value->tbl_regionals_nombre }}</label>
                                                        <br/>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                      Centros
                                                    </button>
                                                  </h2>
                                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @foreach($centro as $value)
                                                        <label class="form-check-label">{{ Form::checkbox('regionales[]', $value->id, false, array('class' => 'tbl_regionals_nombre')) }}
                                                        {{ $value->tbl_centros_nombre }}</label>
                                                        <br/>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                  <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                      Coordinaciones
                                                    </button>
                                                  </h2>
                                                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @foreach($coordinacion as $value)
                                                        <label class="form-check-label">{{ Form::checkbox('regionales[]', $value->id, false, array('class' => 'tbl_regionals_nombre')) }}
                                                        {{ $value->tbl_coordinacions_nombre }}</label>
                                                        <br/>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Sedes
                                                      </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                      <div class="accordion-body">
                                                        @foreach($sede as $value)
                                                        <label class="form-check-label">{{ Form::checkbox('regionales[]', $value->id, false, array('class' => 'tbl_regionals_nombre')) }}
                                                        {{ $value->tbl_sedes_nombre }}</label>
                                                        <br/>
                                                        @endforeach
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                        </div>


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
