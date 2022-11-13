function filtro() {

    car_id = document.getElementById('car_id').value;
    dep_id = document.getElementById('dep_id').value;
    mun_id = document.getElementById('mun_id').value;
    pro_prioridad = document.getElementById('pro_prioridad').value;
    ina_convenio = document.getElementById('ina_convenio').value;
    ina_especialidad = document.getElementById('ina_especialidad').value;
    ina_profesional = document.getElementById('ina_profesional').value;

    document.getElementById('modal_departamento').value = dep_id;
    document.getElementById('modal_municipio').value = mun_id;
    document.getElementById('modal_prioridad').value = pro_prioridad;
    document.getElementById('modal_convenio').value = ina_convenio;
    document.getElementById('modal_especialidad').value = ina_especialidad;
    document.getElementById('modal_medico').value = ina_profesional;

    sendDatos = {
        'tpp_id': 1,
        'car_id': car_id,
        'dep_id': dep_id,
        'mun_id': mun_id,
        'prioridad': pro_prioridad,
        'convenio': ina_convenio,
        'especialidad': ina_especialidad,
        'medico': ina_profesional
    }

    var a_cantidad = document.getElementById('a_cantidad');
    var listado = $("[name=tbody_excel_ina]");
    listado.empty();
    listado.append(
        '<tr><td colspan="7" >Buscando...</td></tr>'
    );

    $.ajax({
        url: '/proceso/e/filtro',
        type: 'GET',
        dataType: 'json',
        data: sendDatos,
        beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        },
        success: function (response) {
            console.log(response);
            var resp = response;
            var data = resp.data;
            var cantidad = resp.cantidad;
            listado.empty();
            if (data.length < 1 || resp.success == false) {
                listado.append(
                    '<tr><td colspan="7">No se encontraron registros</td></tr>'
                );
                a_cantidad.innerHTML = cantidad;
            } else {
                a_cantidad.innerHTML = cantidad;

                for (var i = 0; i < data.length; i++) {

                    var item = data[i];

                    if (item['pro_prioridad'] == 1) {
                        c_style = "fa-solid fa-circle circle-red";
                    } else if (item['pro_prioridad'] == 2) {
                        c_style = "fa-solid fa-circle circle-yellow";
                    } else if (item['pro_prioridad'] == 3) {
                        c_style = "fa-solid fa-circle circle-green";
                    }

                    if(item['ina_estado_consulta'] == null){
                        estado_consulta = "";
                    }else{
                        estado_consulta = item['ina_estado_consulta'];
                    }

                    listado.append(
                        '<tr>' +
                        '<td></td>' +
                        '<td>' +
                        '<span style="display: none;">' + item['pro_prioridad'] + '</span>' +
                        '<i class="' + c_style + '"></i>' +
                        '</td>' +
                        '<td>' + item['tip_alias'] + '</td>' +
                        '<td>' + item['pac_identificacion'] + '</td>' +
                        '<td>' + item['pac_nombre_completo'] + '</td>' +
                        '<td>' + item['dep_nombre'] + '</td>' +
                        '<td>' + item['mun_nombre'] + '</td>' +
                        '<td>' + item['ina_fecha_cita'] + '</td>' +
                        '<td>' + item['ina_convenio_nombre'] + '</td>' +
                        '<td>' + item['ina_medico_nombre'] + '</td>' +
                        '<td>' + item['ina_medico_especialidad'] + '</td>' +
                        '<td>' + item['ina_rotulo'] + '</td>' +
                        '<td>' + item['ina_pym'] + '</td>' +
                        '<td>' + item['ina_modalidad'] + '</td>' +
                        '<td>' + estado_consulta + '</td>' +
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

