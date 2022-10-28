function consulta(car_id, tpp_id){
    var departamento = document.getElementById("departamento");
    var dep = departamento.value;
    var municipio = document.getElementById("municipio");
    var mun = municipio.value;
    var prioridad = document.getElementById("prioridad");
    var pri = prioridad.value;
    var convenio = document.getElementById("convenio");
    var especialidad = document.getElementById("especialidad");
    var punto_de_acopio = document.getElementById("punto_de_acopio");
    var programa = document.getElementById("programa");
    var registro_span = document.getElementById("registro_span");


  switch (tpp_id) {
    //Inasisitidos
    case 1:
        var con = convenio.value;
        var esp = especialidad.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "con" : con,
            "esp" : esp,
        }
        break;

    //Seguimiento
    case 2:
        var esp = especialidad.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "esp" : esp,
        }
        break;

    //Recordatorio
    case 3:
        var esp = especialidad.value;
        var con = convenio.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "con" : con,
            "esp" : esp,
        }
        break;
    //Hospitalizados
    case 4:
        var pro = programa.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "pro" : pro,
        }
        break;

    //Brigadas
    case 5:
        var con = convenio.value;
        var esp = especialidad.value;
        var pa = punto_de_acopio.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "con" : con,
            "esp" : esp,
            "pa"  : pa,
        }
        break;

    //Reprogramacion
    case 6:
        var con = convenio.value;
        var esp = especialidad.value;
        var sendData = {
            "tpp_id" : tpp_id,
            "car_id" : car_id,
            "dep" : dep,
            "mun" : mun,
            "pri" : pri,
            "con" : con,
            "esp" : esp,
        }
        break;

    default:
        break;
  }

console.log(sendData);
  $.ajax({
    url: '/filtro/consulta',
    type: 'GET',
    dataType: 'json',
    data: sendData,
     beforeSend: function () {
        console.log('enviada');
    },
    complete: function () {
        console.log('completada');
    },
    success: function (response) {
        var cantidad = response.cantidad;
        registro_span.innerHTML = cantidad;
        console.log(response);
    },
    error: function (jqXHR) {
        console.log('error!');
    }
});

}






