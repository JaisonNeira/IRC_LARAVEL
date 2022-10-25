let btn_asignar = document.getElementById('btn_asignar');

btn_asignar.onclick = function (){
    $.ajax({
        url: '',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var resp = response;
            var data = resp.data;
            var listado = $("[name=registros_asignar]");
            listado.empty();
                for (var i = 0; i < data.length; i++) {
                    var item = data[i];
                    listado.append(
                        '<tr>' +
                        '<td>' + item['identificacion'] + '</td>' +
                        '<td>' + item['nombre'] + '</td>' +
                        '<td>' + item['apellido'] + '</td>' +
                        '<td>'+
                             '<input type="checkbox" id="cbox1" value="first_checkbox">'+
                        '</td>'+
                        '</td>'
                    );
                }
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });
    
    }