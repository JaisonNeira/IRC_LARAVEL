
function validacion(){
    var todo_ok = true;
    var seleccion = document.getElementById('seleccion');
    var importar = document.getElementById('add_archivo');

    if(seleccion.value == 'Tipo de proceso' || importar.files.length == 0){
        if(seleccion.value == 'Tipo de proceso'){
             document.getElementById('select').style.borderRadius = '4px 4px 4px 4px';
             document.getElementById('select').style.boxShadow= '0px 0px 4px 4px rgba(255, 0, 168, 1)';
             document.getElementById('error1').style.display= 'flex';
        }
        if(importar.files.length == 0){
          document.getElementById('validator').style.boxShadow= '0px 0px 4px 4px rgba(255, 0, 168, 1)';
          document.getElementById('validator2').style.boxShadow= '0px 0px 4px 4px rgba(255, 0, 168, 1)';
          document.getElementById('error2').style.display= 'flex';
        }
      return todo_ok = false;
   }
}
