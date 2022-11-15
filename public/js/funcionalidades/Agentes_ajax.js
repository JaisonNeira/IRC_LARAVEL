// $(document).ready(function() {
//     $('#mostrar_contrasena').click(function() {
//         if ($('#mostrar_contrasena').is(':checked')) {
//             $('#password').attr('type', 'text');
//         } else {
//              $('#password').attr('type', 'password');
//         }
//     });
// });

function mostrar_contraseña(){
    var check = document.getElementById("mostrar_contrasena2");
    var password = document.getElementById("password1");
    if (check.checked) {
        password.type = "text";
    } else {
         password.type = "password";
    }
}

function cambiar_bg(){
    var aeiou = document.getElementById("gestiones");
    aeiou.style.backgroundColor ="#E22A3D";
}









