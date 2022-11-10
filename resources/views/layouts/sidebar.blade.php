<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-start" style="background-color: white; min-height: 74px;"
    href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/IRCicon 1.png')}}" class="img-fluid" width="170" height="50">
        </div>
    </a>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    {{-- importar item --}}
    @can('ver-importar')
    <li class="nav-item active items m-t-5 mb-0" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('importar.index') }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-cloud-arrow-up text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span>Importar</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan

    @can('ver-procesos')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('proceso.index') }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-pencil text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span style="line-height: 10px;">Administrar<br>Proceso</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan

    @can('ver-captaciones')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('captaciones.index') }}">
            <div class="d-flex flex-column ">
                <i class="fas fa-users text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span style="line-height: 10px;">Administrar<br>Captaciones</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan

    @can('ver-gestionar')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('gestionar.index', Auth::user()->id) }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-house-medical-circle-check text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span>Gestionar</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan

    @can('ver-consultar')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('consultas.index') }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-folder-open text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span style="line-height: 10px;">Consultar<br>pacientes</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan


    @can('ver-administracion')
        <li class="nav-item active" style="margin-top: 10px!important;">
            <a class="nav-link collapsed" {{-- href="#" --}} data-toggle="collapse" data-target="#gestiones"
                aria-expanded="true" aria-controls="collapsePages">
                <div class="d-flex flex-column ">
                    <i class="fa-solid fa-user-doctor text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span>Administracion</span></div>
                </div>
                <hr class="sidebar-divider">
            </a>
            <div id="gestiones" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded">


                    @can('ver-roles')
                        <a class="nav-link" href="{{ route('indexRol') }}">
                            <i class="fas fa-id-badge"></i>
                            <span>Gestionar Roles</span></a>
                    @endcan

                    @can('ver-usuarios')
                        <a class="nav-link" href="{{ route('indexUser') }}">
                            <i class="fas fa-user"></i>
                            <span>Usuarios</span></a>
                    @endcan

                    @can('ver-agentes')
                        <a class="nav-link" href="{{ route('administracion.index') }}">
                            <i class="fas fa-user"></i>
                            <span>Agentes</span></a>
                    @endcan

                </div>
            </div>
        </li>
    @endcan

    @can('ver-reportes')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('reportes.index') }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-clipboard text-center" style="font-size: 30px;"></i>
                <div Class="text-center"><span>Reportes</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan

    @can('ver-centro-ayuda')
    <li class="nav-item active items m-t-5" style="margin-top: 10px!important;">
        <a class="nav-link" href="{{ route('ayuda.index') }}">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-handshake-angle text-center" style="font-size: 30px;"></i>
                <div Class="text-center"><span>Centro Ayuda</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    @endcan


</ul>
