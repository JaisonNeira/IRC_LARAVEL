$(document).ready(function() {
    $('#mostrar_contrasena').click(function() {
        if ($('#mostrar_contrasena').is(':checked')) {
            $('#password').attr('type', 'text');
            $('#password_2').attr('type', 'text');
        } else {
             $('#password').attr('type', 'password');
            $('#password_2').attr('type', 'password');
        }
    });
});









