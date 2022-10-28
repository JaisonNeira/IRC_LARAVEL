
function consulta(car_id, tpp_id){

    var departamento = document.getElementById("departamento_"+car_id);
    var dep = departamento.value;
    var municipio = document.getElementById("municipio_"+car_id);
    var mun = municipio.value;
    var prioridad = document.getElementById("prioridad_"+car_id);
    var pri = prioridad.value;
    var convenio = document.getElementById("convenio_"+car_id);
    var especialidad = document.getElementById("especialidad_"+car_id);
    var punto_de_acopio = document.getElementById("punto_de_acopio_"+car_id);
    var programa = document.getElementById("programa_"+car_id);
    var registro_span = document.getElementById("registro_span_"+car_id);

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

// console.log(sendData);
  $.ajax({
    url: '/filtro/consulta',
    type: 'GET',
    dataType: 'json',
    data: sendData,
    /* beforeSend: function () {
        console.log('enviada');
    },
    complete: function () {
        console.log('completada');
    }, */
    success: function (response) {
        var cantidad = response.cantidad;
        registro_span.innerHTML = cantidad;

        if(registro_span.textContent == "" || registro_span.textContent == 0){
            registro_span.style.background = "rgb(175, 32, 32)";
         }else{
            registro_span.style.background = "rgb(30, 160, 89)";
         }
    },
    error: function (jqXHR) {
        console.log('error!');
    }
});

}


$('#seleccionar_todo').click(function () {
    $('.chboxid').prop('checked', $ (this).prop('checked'));
});

function valida_agentes(){

}






