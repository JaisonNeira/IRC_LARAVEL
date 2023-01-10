<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IRC - registro</title>
    <link rel="shortcut icon" href="{{ asset('img/ircicon_page_2.png') }}" type="image/x-icon">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="nav-item">
                    <a style="background-color: white; min-height: 74px;" href="{{ route('home') }}">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('img/IRCicon 1.png') }}" class="img-fluid" width="170" height="50">
                        </div>
                    </a>
                </div>
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('img/icon_woman.svg') }}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ver perfil
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Salir
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>





            <!--------------------------- Aqui empieza perfil ------------------------------->
            <div class="container-fluid">

                <div class="col-12 text-center">
                    <h1>Tu Perfil</h1>
                    <img src="{{ asset('img/logo_verperfil.png') }}" alt=""
                        style="max-width: 500px; max-height: 200px;">
                </div>
                <form action="" class="row p-2 m-4 g-3"
                    style="padding-left: 200px !important; padding-right: 200px!important;">
                    <div class="col-6">
                        <label for="nombre" class="form-label" style="font-weight: bold"> Nombre del usuario
                        </label>

                        {{-- input nombre --}}
                        <input id="nombre" type="text" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label" style="font-weight: bold"> Correo del usuario
                        </label>
                        {{-- input correo del usuario --}}
                        <input id="email" type="email" class="form-control ">
                    </div>

                    <div class="col-6 mt-2">
                        <label for="password"class="form-label" style="font-weight: bold"> Contraseña
                        </label>
                        {{-- input contraseña --}}
                        <input id="password" type="password" class="form-control ">
                        <div style="margin-top:15px;">
                            <input style="margin-left:20px;" type="checkbox" id="mostrar_contrasena"
                                title="clic para mostrar contraseña" />
                            &nbsp;&nbsp;Mostrar Contraseña
                        </div>
                    </div>

                    <div class="col-6 mt-2 mb-2">
                        <label for="password_2"class="form-label" style="font-weight: bold"> Confirmar contraseña
                        </label>

                        {{-- Confirmar contraseña --}}
                        <input id="password_2" type="password" class="form-control ">
                    </div>
            </div>

            <div class="col-12 mt-5 text-center">
                <button class="btn btn-primary" type="submit" style="min-width: 200px">Guardar</button>
            </div>
            </form>


        </div>
        <!--------------------------- Aqui termina perfil ------------------------------->






    </div>
    </div>








    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #E22A3D">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">Desea cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "salir" para cerrar su sesión.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}" data-toggle="modal"
                        data-target="#logoutModal"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Salir') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/funcionalidades/agentes_ajax.js') }}"></script>
</body>

</html>
