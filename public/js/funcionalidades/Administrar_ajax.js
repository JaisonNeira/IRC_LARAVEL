window.onload = function () {
$.ajax({
    url: '/proceso/tabla',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        var resp = response;
        var data = resp.cargues;
        console.log(response);
        var listado = $("[name=registros]");
        listado.empty();
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                listado.append(
                    '<tr>' +
                    '<td>' + item['car_fecha_cargue'] + '</td>' +
                    '<td>' + item['car_mes'] + '</td>' +
                    '<td>' + item['car_fecha_reporte'] + '</td>' +
                    '<td>' + item['tpp_nombre'] + '</td>' +
                    '<td>'+
                        '<div class="custom-control custom-switch">'+
                              '<input type="checkbox" class="custom-control-input" id="customSwitch1">'+
                             '<label class="custom-control-label" for="customSwitch1" style=""></label>'+
                        '</div>'+
                    '</td>'+
                     '<td>'+
                        "<?php @include('administrar_procesos.modal_asignar') ?>"+
                    '</td>'
                );
            }
    },
    error: function (jqXHR) {
        console.log('error!');
    }
});

}
