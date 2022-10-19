
function validacion(){
    var todo_ok = true;
    var seleccion = document.getElementById('seleccion');
    var importar = document.getElementById('a');

    if(seleccion.value == 'Tipo de proceso' || importar.value == 'Selecciona un archivo'){
        console.log(importar.files.length);
        if(seleccion.value == 'Tipo de proceso'){
             document.getElementById('a').style.border = '3px solid #E22A3D';
             document.getElementById('a').style.borderRadius = '4px 4px 4px 4px';
        }else
             document.getElementById('a').style.border = '3px solid #E22A3D';
             document.getElementById('a').style.borderRadius = '4px 4px 4px 4px';

        if(importar.importar.value == 'Selecciona un archivo'){
            document.getElementById('imp').style.border = '3px solid #E22A3D';
            document.getElementById('imp').style.borderRadius = '4px 4px 4px 4px';
        }
       alert('Campos sin llenar');
      return todo_ok = false;
   }
}
