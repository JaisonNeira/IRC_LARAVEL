function prioridad (id) {
  var prioridad = document.getElementById("prioridad_var_"+id);
  var red = document.getElementById("pri_red_"+id);
  var yellow = document.getElementById("pri_yellow_"+id);
  var green = document.getElementById("pri_green_"+id);

  if (prioridad.textContent == "1") {
     red.style.display ="inline";
  }
  if (prioridad.textContent == "2"){
    yellow.style.display ="inline";
  }
  if (prioridad.textContent == "3"){
    green.style.display ="inline";
  }
}

