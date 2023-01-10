<div class="col-lg-12">
    <div class="row p-3">
        <div class="col-12">
            <h1 style="font-weight: bold;">Generador de reportes de agente</h1>
        </div>

        <div class="col-12">
            @include('layouts.msj')
            <div class="table-responsive">
                <table id="table3" class="table table-bordered">
                    <thead style="background-color: #E22A3D; color:#ffff; text-align:center;">
                        <tr>
                            <th style="text-align: center;">Identificacion</th>
                            <th style="text-align: center;">Nombre Completo</th>
                            <th style="text-align: center;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #ffff; text-align: center;">
                        @foreach ($agentes as $agente)
                            <tr>
                                <td>{{ $agente->age_documento }}</td>
                                <td>{{ $agente->name }}</td>
                                <td class="mr-3" style="padding-left: 40px;">

                                    <form action="{{ route('reportes.agente.get', $agente->age_id) }}" method="GET"
                                        style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" rel="tooltip">
                                            <i class="fas fa-file-pdf" style="font-size: 25px"></i>
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
