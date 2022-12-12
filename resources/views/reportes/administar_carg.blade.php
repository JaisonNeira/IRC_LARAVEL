<div class="col-lg-12">
    <div class="row p-3">
        <div class="col-12">
            <h1 style="font-weight: bold;">Administrar Cargues</h1>
        </div>

        <div class="col-12">
            @include('layouts.msj')
            <div class="table-responsive">
                <table id="table3" class="table table-bordered">
                    <thead style="background-color: #E22A3D; color:#ffff; text-align:center;">
                        <tr>
                            <th style="text-align: center;">Fecha Cargue</th>
                            <th style="text-align: center;">Mes Cargue</th>
                            <th style="text-align: center;">Nombre Archivo</th>
                            <th style="text-align: center;">Fecha de Reporte</th>
                            <th style="text-align: center;">Cantidad Registros</th>
                            <th style="text-align: center;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffff; text-align: center;">
                        @foreach ($cargues as $list)
                        <tr>
                            <td>{{ $list->car_fecha_cargue }}</td>
                            <td>{{ $list->car_mes }}</td>
                            <td>{{ $list->Acc_nombre }}</td>
                            <td>{{$list->car_fecha_reporte}}</td>
                            <td>{{$list->Acc_cargados}}</td>
                            <td>
                                <form action="{{ route('reportes.administrar.cargues', $list->car_id) }}" method="GET"
                                    style="display: inline-block; ">
                                    @csrf
                                    <input type="text" style="display: none;" name="tpp_id" value="{{$list->tpp_id}}">
                                    <input type="text" style="display: none;" name="file_name" value="{{$list->Acc_nombre}}">
                                    <button type="submit" class="btn btn-primary" rel="tooltip">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
