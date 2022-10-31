
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
                        '<td>' + item['ges_resultado'] + '</td>' +
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

function limpiar(){
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
    listado.empty();
    listado.append(
        '<tr><td colspan="5" >Buscando...</td></tr>'
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
                        '<td>' + item['ges_resultado'] + '</td>' +
                        '<td>' + item['ges_comentario'] + '</td>' +
                        '</tr>'
                    );
                }
            }

            info_empleado.empty();
            info_empleado.append(
                '<tr>' +
                '<th scope="row">Cedula</th>' +
                '<td>' + resp.emp_cedula + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th scope="row">Nombre</th>' +
                '<td>' + resp.emp_nombre + '</td>' +
                '</tr>' +
                '<tr>' +
                '<th scope="row">Cargo</th>' +
                '<td>' + resp.emp_cargo + '</td>' +
                '</tr>'
            );

            var info_calificacion = $("[name=info_calificacion]");
            info_calificacion.empty();
            info_calificacion.append(
                '<tr>'+
                '<th scope="row">Codigo</th>'+
                '<td colspan="3">'+ resp.cal_codigo +'</td>'+
              '</tr>'+
              '<tr>'+
                '<th scope="row">Curso</th>'+
                '<td>'+ resp.cur_nombre +'</td>'+
                '<th scope="row">Encargado</th>'+
                '<td>'+ resp.enc_nombre +'</td>'+
              '</tr>'+
              '<tr>'+
                '<th scope="row">Calificacion</th>'+
               '<td colspan="3">'+ resp.cal_calificacion+'</td>'+
              '</tr>'
            );

        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
}


