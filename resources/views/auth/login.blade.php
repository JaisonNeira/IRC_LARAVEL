<!doctype html>
<html lang="en">
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
                <div class="container mb-5 text-center pt-3" style="height: 25%">
                    <img src="https://static.wixstatic.com/media/c79d06_a115601f06d343e483207fa5ffa01fca~mv2.png/v1/fill/w_336,h_210,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/logo%20animar%20IRC.png"
                        class="img-fluid" alt="Responsive Image" style="width: 50%">
                </div>
                <!-- form login -->
                <form method="POST" action="{{ route('login') }}" class="px-2 py-2">
                    @csrf
                    <div class="mb-4">
                        <label for="user"class="form-label fw-bold"> Usuario </label>
                        <input id="email" type="email"
                            class="form-control form-control-user @error('email') is-invalid @enderror input_login" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Escribe un correo">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password1" class="form-label fw-bold"> Contrase??a </label>
                        <input id="password1" type="password"
                            class="form-control @error('password') is-invalid @enderror input_login" name="password" required
                            autocomplete="current-password" placeholder="Escribe una contrase??a">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="mostrar_contrasena2" title="clic para mostrar contrase??a"
                            onchange="mostrar_contrase??a()" />
                        &nbsp;&nbsp;Mostrar Contrase??a
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" style="border-radius: 2px;">Iniciar sesi??n</button>
                    </div>
                </form>

                {{-- <div class="mb-4 py-2">
                    <a href="#" class=""> Recuperar contrase??a</a>
                </div> --}}
                <!-- end form login-->
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/funcionalidades/Agentes_ajax.js') }}"></script>
</body>

</html>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
