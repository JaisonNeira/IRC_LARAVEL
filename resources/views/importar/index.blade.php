@extends('layouts.main')

@section('title')
Importar
@endsection


@section('content')
<div class="container-fluid">
<h1  style="font-weight: bold;">Selecciona el tipo de proceso</h1>
<div class="select shadow-sm">
   <select name="format" id="format" style="font-weight: bold;">
      <option selected disabled>Tipo de proceso</option>
      <option value="1" style="color: #000000" class="opcion">Inasistidos</option>
      <option value="2" style="color: #000000" class="opcion">Seguimiento demanda inducida</option>
      <option value="3" style="color: #000000" class="opcion">Recordatorios</option>
      <option value="4" style="color: #000000" class="opcion">Hospitalizados</option>
      <option value="5" style="color: #000000" class="opcion">Brigadas</option>
      <option value="6" style="color: #000000" class="opcion">Reprogramacion</option>
   </select>
</div>
</div>


</div>
@endsection
