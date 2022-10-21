<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> IRC - Login</title>
    <link rel="shortcut icon" href="img/ircicon_page_2.png" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="degradado-irc">
    <div class="container shadow mt-5 bg-normal w-80 rounded">
        <div class="row align-items-stretch">
            <div class="col d-none d-lg-block col-md-5 col-lg-6 col-xl-6" style="padding-left: 0">
                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80"
                    class="img-fluid" alt="Responsive image">
            </div>
            <div class="col" style="padding-right: 3em">
                <div class="text-end">
                </div>
                <div class="container mb-5 text-center" style="height: 25%">
                    <img src="img/IRCicon 1.png" class="img-fluid" alt="Responsive Image" style="width: 75%">
                </div>
                <!-- form login -->
                <form action="#">
                    <div class="mb-4">
                        <label for="user"class="form-label fw-bold"> Usuario </label>
                        <input type="email" class="form-control" name="user"
                            placeholder="Escribe tu nombre de usuario" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold"> Contraseña </label>
                        <input type="password" class="form-control" name="user" placeholder="Escribe tu contraseña"
                            required>
                    </div>
                    <div class="mb-4">
                        <a href="#" class=""> Recuperar contraseña</a>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold"> Iniciar sesión</button>
                    </div>
                </form>
                <!-- end form login-->
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
