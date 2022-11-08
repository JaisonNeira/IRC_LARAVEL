<!-- Modal -->
@foreach ($procesos as $list)
    <div class="modal fade" id="modal_asignar_{{ $list->pro_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #E22A3D">
                    <h4 class="text-white">Asignar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <form action="{{ route('captaciones.asignar') }}" method="POST" name="form-data"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="pro_id" value="{{ $list->pro_id }}" style="display: none;">
                                        <table id="table2" class="table table-bordered">
                                            <thead
                                                style="background-color: #E22A3D; color:#ffff; text-align: center !important;">
                                                <tr>
                                                    <th class="text-center th_a py-3">
                                                        Identificacion</th>
                                                    <th class="text-center th_a py-3">Nombre Completo</th>
                                                    <th class="text-center py-3 px-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="seleccionar_todo">
                                                            <label class="form-check-label" for="selecionar_todo">
                                                                Seleccionar todos
                                                            </label>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: #ffff; text-align: center;"
                                                id="registros_asignar" name="registros_asignar">


                                                @foreach ($agentes as $agente)
                                                    <tr>
                                                        <td>{{ $agente->age_documento }}</td>
                                                        <td>{{ $agente->name }}</td>
                                                        <td class="mr-3" style="padding-left: 40px;">
                                                            <input class="form-check-input all_select" type="checkbox"
                                                                name="ids[]" value="{{ $agente->age_id }}"
                                                                id="check_{{ $agente->age_id }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{-- <tr>
                                        <td>1042241113</td>
                                        <td>Jaison</td>
                                        <td>Neira</td>
                                        <td>
                                            <input type="checkbox" id="cbox1" value="first_checkbox">
                                        </td>
                                    </tr> --}}
                                            </tbody>
                                        </table>
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="float: right;">Asignar
                                                agentes</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
