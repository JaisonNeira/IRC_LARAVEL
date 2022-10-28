function cargarEstado(sendDatos){
    $.ajax({
            url: '/proceso/c/estado',
            type: 'GET',
            dataType: 'json',
            data: sendDatos,
            /* beforeSend: function () {
                console.log('enviada');
            },
            complete: function () {
                console.log('completada');
            },
            success: function (response) {
                console.log(response);
            }, */
            error: function (jqXHR) {
                console.log('error!');
            }
        });
}

function cambio(id){
    const sendDatos = {
        'car_id': id
    }
    cargarEstado(sendDatos);
}






