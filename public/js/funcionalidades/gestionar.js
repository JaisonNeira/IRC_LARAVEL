
function modal_proceso(pac_id) {

    var listado = $("[name=tbody_modal_proceso]");
    listado.empty();
    listado.append(
        '<tr><td colspan="5" >Buscando...</td></tr>'
    );

    data = {
        'pac_id': pac_id
    }

    $.ajax({
        url: '/gestionar/modal/proceso',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="5" >No se encontraron registros</td></tr>'
                );
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    listado.append(
                        '<tr>' +
                        '<td>' + item['tpp_nombre'] + '</td>' +
                        '<td>' + item['car_activo'] + '</td>' +
                        '<td>' + item['car_mes'] + '</td>' +
                        '<td>' + item['car_fecha_cargue'] + '</td>' +
                        '<td>' + item['car_fecha_reporte'] + '</td>' +
                        '</tr>'
                    );
                }
            }
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}

function modal_perfil(pac_id) {
    limpiar();
    var listado = $("[name=tbody_modal_perfil]");
    listado.empty();
    listado.append(
        '<tr><td colspan="7" >Buscando...</td></tr>'
    );

    data = {
        'pac_id': pac_id
    }

    $.ajax({
        url: '/gestionar/modal/perfil',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="7">No se encontraron registros</td></tr>'
                );
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    listado.append(
                        '<tr>' +
                        '<td>' + item['tpp_nombre'] + '</td>' +
                        '<td>' + item['car_mes'] + '</td>' +
                        '<td>' + item['car_fecha_cargue'] + '</td>' +
                        '<td>' + item['ges_fecha'] + '</td>' +
                        '<td>' + item['name'] + '</td>' +
                        '<td>' + item['tge_nombre'] + '</td>' +
                        '<td>' + item['ges_comentario'] + '</td>' +
                        '</tr>'
                    );
                }
            }

            var paciente = resp.paciente;

            $("#perfil_nombre").text(paciente[0]['pac_nombre_completo']);
            $("#perfil_numero_documento").text(paciente[0]['pac_identificacion']);
            $("#perfil_tipo_documento").text(paciente[0]['tip_alias']);
            $("#perfil_sexo").text(paciente[0]['pac_sexo']);
            $("#perfil_telefono").text(paciente[0]['pac_telefono']);
            $("#perfil_nacimiento").text(paciente[0]['pac_fecha_nacimiento']);
            $("#perfil_direccion").text(paciente[0]['pac_direccion']);
            $("#perfil_departamento").text(paciente[0]['dep_nombre']);
            $("#perfil_municipio").text(paciente[0]['mun_nombre']);
            $("#perfil_afiliado").text(paciente[0]['pac_regimen_afiliacion_SGSS']);

        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}

function limpiar() {
    $("#perfil_nombre").text('');
    $("#perfil_numero_documento").text('');
    $("#perfil_tipo_documento").text('');
    $("#perfil_sexo").text('');
    $("#perfil_telefono").text('');
    $("#perfil_nacimiento").text('');
    $("#perfil_direccion").text('');
    $("#perfil_departamento").text('');
    $("#perfil_municipio").text('');
    $("#perfil_afiliado").text('');
}

function modal_gestion(pro_id, tpp_id, pac_id) {
    var listado = $("[name=tbody_modal_gestion]");
    var info_empleado = $("[name=tbody_modal_info_personal]");
    var info_proceso = $("[name=tbody_modal_info_proceso]");
    info_empleado.empty();
    info_proceso.empty();
    listado.empty();
    listado.append(
        '<tr><td colspan="5" >Buscando...</td></tr>'
    );
    info_empleado.append(
        '<tr><td colspan="6" >Buscando...</td></tr>'
    );
    info_proceso.append(
        '<tr><td colspan="6" >Buscando...</td></tr>'
    );

    data = {
        'pro_id': pro_id,
        'tpp_id': tpp_id,
        'pac_id': pac_id,
    }

    $.ajax({
        url: '/gestionar/modal/gestion',
        type: 'GET',
        dataType: 'json',
        data: data,
        /* beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        }, */
        success: function (response) {
            var resp = response;
            var data = resp.data;
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="5">No se encontraron registros</td></tr>'
                );
            } else {

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    listado.append(
                        '<tr>' +
                        '<td>' + item['ges_fecha'] + '</td>' +
                        '<td>' + item['name'] + '</td>' +
                        '<td>' + item['tge_nombre'] + '</td>' +
                        '<td>' + item['ges_comentario'] + '</td>' +
                        '</tr>'
                    );
                }
            }


            info_empleado.empty();
            info_proceso.empty();

            var paciente = resp.paciente;

            for (var i = 0; i < paciente.length; i++) {

                var item = paciente[i];

                $('#pac_id').val(item['pac_id']);

                info_empleado.append(
                    '<tr>' +
                    '<th scope="row" >Documento</th>' +
                    '<td colspan="2">' + item['tip_alias'] + ' - ' + item['pac_identificacion'] + '</td>' +
                    '<th scope="row">Nombre</th>' +
                    '<td colspan="2">' + item['pac_nombre_completo'] + '</td>' +
                    '<th scope="row">Telefono</th>' +
                    '<td colspan="2">' + item['pac_telefono'] + '</td>' +
                    '</tr>'
                );
            }

            var proceso = resp.proceso;

            for (var i = 0; i < proceso.length; i++) {

                var item = proceso[i];
                $('#tpp_id').val(item['tpp_id']);
                $('#pro_id').val(item['pro_id']);

                switch (item['tpp_id']) {
                    case 1:
                        /* INASISTIDOS */

                        $('#span_proceso').text('Informacion de la inasistencia')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Fecha cita</th>' +
                            '<td>' + item['ina_fecha_cita'] + '</td>' +
                            '<th scope="row">Medico</th>' +
                            '<td>' + item['ina_medico_nombre'] + '</td>' +
                            '<th scope="row">Medico especialidad</th>' +
                            '<td>' + item['ina_medico_especialidad'] + '</td>' +
                            '<th scope="row">Convenio</th>' +
                            '<td>' + item['ina_convenio_nombre'] + '</td>' +
                            '<th scope="row">Motivo</th>' +
                            '<td>' + item['ina_motivo_inasistencia'] + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th scope="row">Rotulo</th>' +
                            '<td>' + item['ina_rotulo'] + '</td>' +
                            '<th scope="row">PYM</th>' +
                            '<td>' + item['ina_pym'] + '</td>' +
                            '<th scope="row">Modalidad</th>' +
                            '<td>' + item['ina_modalidad'] + '</td>' +
                            '<th scope="row">Estado consulta</th>' +
                            '<td>' + item['ina_estado_consulta'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case 2:
                        /* SEGUIMIENTOS */

                        $('[name=div_input_datetime]').css("display", "block");
                        $('#span_proceso').text('Informacion del seguimiento')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Fecha ultimo control</th>' +
                            '<td>' + item['sdi_fecha_ultimo_control'] + '</td>' +
                            '<th scope="row">Fecha cita</th>' +
                            '<td>' + item['sdi_fecha_cita'] + '</td>' +
                            '<th scope="row">Especialidad</th>' +
                            '<td>' + item['sdi_especialidad'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case 3:
                        /* RECORDATORIOS */

                        $('#span_proceso').text('Informacion del recordatorio')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Fecha cita</th>' +
                            '<td>' + item['rec_fecha_cita'] + '</td>' +
                            '<th scope="row">Medico</th>' +
                            '<td>' + item['rec_profesional'] + '</td>' +
                            '<th scope="row">Medico especialidad</th>' +
                            '<td>' + item['rec_especialidad'] + '</td>' +
                            '<th scope="row">Convenio</th>' +
                            '<td>' + item['rec_convenio'] + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th scope="row">Tipo recordatorio</th>' +
                            '<td>' + item['rec_tipo_de_recordatorio'] + '</td>' +
                            '<th scope="row">PYM</th>' +
                            '<td>' + item['rec_pym'] + '</td>' +
                            '<th scope="row">Modalidad</th>' +
                            '<td>' + item['rec_modalidad'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case 4:
                        /* HOSPITALIZADOS */

                        $('#span_proceso').text('Informacion de la hospitalizacion')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Diagnostico</th>' +
                            '<td>' + item['hos_diagnostico'] + '</td>' +
                            '<th scope="row">Fecha ingreso</th>' +
                            '<td>' + item['hos_fecha_ingreso'] + '</td>' +
                            '<th scope="row">Fecha egreso</th>' +
                            '<td>' + item['hos_fecha_egreso'] + '</td>' +
                            '<th scope="row">Programa</th>' +
                            '<td>' + item['hos_programa'] + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th scope="row">Pertenece a irc?</th>' +
                            '<td>' + item['hos_pertenece_irc'] + '</td>' +
                            '<th scope="row">Programa</th>' +
                            '<td>' + item['hos_programa'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case 5:
                        /* BRIGADA */

                        $('#span_proceso').text('Informacion de la  brigada')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Fecha brigada</th>' +
                            '<td>' + item['bri_fecha'] + '</td>' +
                            '<th scope="row">Punto de acopio</th>' +
                            '<td>' + item['bri_punto_acopio'] + '</td>' +
                            '<th scope="row">Convenio</th>' +
                            '<td>' + item['bri_convenio'] + '</td>' +
                            '<th scope="row">Especialidad</th>' +
                            '<td>' + item['bri_especialidad'] + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th scope="row">Fecha cita</th>' +
                            '<td>' + item['bri_dias_transcurrido'] + '</td>' +
                            '<th scope="row">Fecha de ultimo control</th>' +
                            '<td>' + item['bri_fecha_ultimo_control'] + '</td>' +
                            '<th colspan="3" scope="row">Dias desde el ultimo control</th>' +
                            '<td>' + item['bri_fecha_cita'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case 6:
                        /* REPROGRAMACION */

                        $('[name=div_input_datetime]').css("display", "block");
                        $('#span_proceso').text('Informacion de la reprogramacion')
                        info_proceso.append(
                            '<tr>' +
                            '<th scope="row">Convenio</th>' +
                            '<td>' + item['rep_convenio'] + '</td>' +
                            '<th scope="row">Fecha cita</th>' +
                            '<td>' + item['rep_fecha_cita'] + '</td>' +
                            '<th scope="row">Especialidad</th>' +
                            '<td>' + item['rep_especialidad'] + '</td>' +
                            '<th scope="row">Medico</th>' +
                            '<td>' + item['rep_profesional'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    default:

                        info_proceso.append(
                            '<tr><td colspan="6">No se encontraron informacion</td></tr>'
                        );

                        break;
                }



            }

        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}


