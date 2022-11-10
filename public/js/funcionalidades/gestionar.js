
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
                    '<td class="text-center" scope="col">' + item['tip_alias'] + ' - ' + item['pac_identificacion'] + '</td>' +
                    '<td class="text-center" scope="col">' + item['pac_nombre_completo'] + '</td>' +
                    '<td class="text-center" scope="col">' + item['pac_telefono'] + '</td>' +
                    '</tr>'
                );
            }

            var proceso = resp.proceso;

            for (var i = 0; i < proceso.length; i++) {

                var item = proceso[i];
                $('#tpp_id').val(item['tpp_id']);
                $('#pro_id').val(item['pro_id']);
                switch (item['tpp_id'].toString()) {
                    case "1":
                        /* INASISTIDOS */

                        $('#span_proceso').text('Informacion de la inasistencia')
                        info_proceso.append(
                            //Inasistidos Titulos 1
                            '<tr>'+
                            '<td class="bold">Fecha cita</td>' +
                            '<td class="bold center_text">Medico</td>' +
                            '<td class="bold">Medico especialidad</td>' +
                            '<td class="bold center_text">Convenio</td>' +
                            '</tr>'+
                             //Inasistidos Registros 1
                            '<tr>' +
                            '<td class="text-center">' + item['ina_fecha_cita'] + '</td>' +
                            '<td class="text-center">' + item['ina_medico_nombre'] + '</td>' +
                            '<td class="text-center">' + item['ina_medico_especialidad'] + '</td>' +
                            '<td class="text-center">' + item['ina_convenio_nombre'] + '</td>' +
                            '</tr>' +

                            //Inasistidos Titulos 2
                            '<tr>'+
                            '<td class="bold">Rotulo</td>' +
                            '<td class="bold center_text">PYM</td>' +
                            '<td class="bold">Modalidad</td>' +
                            '<td class="bold center_text">Estado consulta</td>' +
                            '</tr>'+
                             //Inasistidos Registros 2
                            '<tr>' +
                            '<td class="text-center">' + item['ina_rotulo'] + '</td>' +
                            '<td class="text-center">' + item['ina_pym'] + '</td>' +
                            '<td class="text-center">' + item['ina_modalidad'] + '</td>' +
                            '<td class="text-center">' + item['ina_estado_consulta'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "2":
                        /* SEGUIMIENTOS */

                        /* $('[name=div_input_datetime]').css("display", "block"); */
                        $('#span_proceso').text('Informacion del seguimiento')
                        info_proceso.append(
                            //Seguimientos Titulos 1
                            '<tr>'+
                            '<td class="bold">Fecha ultimo control</td>' +
                            /* '<td class="bold center_text">Fecha cita/td>' + */
                            '<td class="bold">Especialidad</td>' +
                            '</tr>'+
                            //Seguimientos Registros 1
                            '<tr>' +
                            '<td class="text-center">' + item['sdi_fecha_ultimo_control'] + '</td>' +
                            /* '<td class="text-center">' + item['sdi_fecha_cita'] + '</td>' + */
                            '<td class="text-center">' + item['sdi_especialidad'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "3":
                        /* RECORDATORIOS */
                        $('#span_proceso').text('Informacion del recordatorio')
                        info_proceso.append(

                            //Recordatorios Titulos 1
                            '<tr>'+
                            '<td class="bold">Fecha cita</td>' +
                            '<td class="bold center_text">Medico</td>' +
                            '<td class="bold">Medico especialidad</td>' +
                            '<td class="bold">Convenio</td>' +
                            '</tr>'+
                            //Recordatorios Registros 1
                            '<tr>' +
                            '<td>' + item['rec_fecha_cita'] + '</td>' +
                            '<td>' + item['rec_profesional'] + '</td>' +
                            '<td>' + item['rec_especialidad'] + '</td>' +
                            '<td>' + item['rec_convenio'] + '</td>' +
                            '</tr>' +

                            //Recordatorios titulos 2
                            '<tr>'+
                            '<td class="bold center_text">PYM</td>' +
                            '<td class="bold center_text">Modalidad</td>' +
                            '</tr>'+
                            //Recordatorios Registros 2
                            '<tr>' +
                            '<td>' + item['rec_pym'] + '</td>' +
                            '<td>' + item['rec_modalidad'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "4":
                        /* HOSPITALIZADOS */

                        $('#span_proceso').text('Informacion de la hospitalizacion')
                        info_proceso.append(

                            //Hospitalizados Titulos 1
                            '<tr>'+
                            '<td class="bold center_text">Diagnostico</td>' +
                            '<td class="bold">Fecha ingreso</td>' +
                            '<td class="bold">Fecha egreso</td>' +
                            '<td class="bold center_text">Programa</td>' +
                            '</tr>'+
                            //Hospitalizados Registros 1
                            '<tr>' +
                            '<td>' + item['hos_diagnostico'] + '</td>' +
                            '<td>' + item['hos_fecha_ingreso'] + '</td>' +
                            '<td>' + item['hos_fecha_egreso'] + '</td>' +
                            '<td>' + item['hos_programa'] + '</td>' +
                            '</tr>' +

                            //Hospitalizados Titulos 2
                            '<tr>'+
                            '<td class="bold">Pertenece a IRC?</td>' +
                            '<td class="bold center_text">Programa</td>' +
                            '</tr>'+
                            //Hospitalizados Registros 2
                            '<tr>' +
                            '<td>' + item['hos_pertenece_irc'] + '</td>' +
                            '<td>' + item['hos_programa'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "5":
                        /* BRIGADA */
                        $('#span_proceso').text('Informacion de la  brigada')
                        info_proceso.append(
                            //Brigadas Titulos 1
                            '<tr>'+
                            '<td class="bold">Fecha brigada</td>' +
                            '<td class="bold">Punto de acopio</td>' +
                            '<td class="bold center_text">Convenio</td>' +
                            '<td class="bold center_text">Especialidad</td>' +
                            '</tr>'+
                            //Brigadas Registros 1
                            '<tr>' +
                            '<td class="text-center">' + item['bri_fecha'] + '</td>' +
                            '<td class="text-center">' + item['bri_punto_acopio'] + '</td>' +
                            '<td class="text-center">' + item['bri_convenio'] + '</td>' +
                            '<td class="text-center">' + item['bri_especialidad'] + '</td>' +
                            '</tr>'+

                            //Brigadas Titulos 2
                            '<tr>'+
                            '<td class="bold center_text">Fecha cita</td>' +
                            '<td class="bold">Fecha de ultimo control</td>' +
                            '<td class="bold">Dias desde el ultimo control</td>' +
                            '</tr>'+
                            //Brigadas Registros 2
                            '<tr>'+
                            '<td class="text-center">' + item['bri_fecha_cita'] + '</td>' +
                            '<td class="text-center">' + item['bri_fecha_ultimo_control'] + '</td>' +
                            '<td class="text-center">' + item['bri_dias_transcurrido'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "6":
                        /* REPROGRAMACION */

                        /* $('[name=div_input_datetime]').css("display", "block"); */
                        $('#span_proceso').text('Informacion de la reprogramacion')
                        info_proceso.append(
                            //Reprogramacion titulos 1
                            '<tr>'+
                            '<td class="bold center_text">Convenio</td>' +
                            /* '<td class="bold">Fecha cita</td>' + */
                            '<td class="bold">Especialidad</td>' +
                            '<td class="bold">Medico</td>' +
                            '</tr>'+
                            //Reprogramacion Registros 1
                            '<tr>' +
                            '<td>' + item['rep_convenio'] + '</td>' +
                            /* '<td>' + item['rep_fecha_cita'] + '</td>' + */
                            '<td>' + item['rep_especialidad'] + '</td>' +
                            '<td>' + item['rep_profesional'] + '</td>' +
                            '</tr>'
                        );

                        break;
                    case "7":
                            /* REPROGRAMACION */

                            /* $('[name=div_input_datetime]').css("display", "block"); */
                            $('#span_proceso').text('Informacion de la captacion')
                            info_proceso.append(
                                '<tr><td colspan="6">No se ha encontrado informacion</td></tr>'
                            );

                            break;
                    default:

                        info_proceso.append(
                            '<tr><td colspan="6">No se ha encontrado informacion</td></tr>'
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

function  activar(){
    var historial = document.getElementById("historial");
    var texto_ver = document.getElementById("texto_ver");

    //console.log(informacion.style.display);
    //console.log(historial.style.display);

    if(historial.style.display == "none"){
        //console.log("si sirve le condicional");
        historial.style.display = "";
        texto_ver.textContent = "Ocultar Historial";
    }else if(historial.style.display == ""){
        //console.log("tercero");
        historial.style.display = "none";
        texto_ver.textContent = "Mostrar Historial";
    }
}

function desactivar(){
    //var informacion = document.getElementById("informacion");
    var historial = document.getElementById("historial");
    var texto_ver = document.getElementById("texto_ver");

        //informacion.style.display = "none";
        historial.style.display = "none";
        texto_ver.textContent = "Ver mas";
}



