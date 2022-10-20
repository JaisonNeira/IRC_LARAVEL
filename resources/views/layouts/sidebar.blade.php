<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-start" style="background-color: white;">
        <div class="sidebar-brand-icon" >
            <img src="img/IRCicon 1.png" class="img-fluid" width="170" height="50">
        </div>
    </div>

    <!-- Divider -->


    <!-- Nav Item - Dashboard -->
    {{-- importar item --}}
    <li class="nav-item active items m-t-5 mb-0" style="margin-top: 15px!important;">
        <a class="nav-link" href="{{ route('importar.index')}}">
            <div class="d-flex flex-column ">
                <i  class="fa-solid fa-cloud-arrow-up text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span>Importar</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>

    <li class="nav-item active items m-t-5">
        <a class="nav-link" href="#">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-pencil text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span style="line-height: 10px;">Administrar<br>Proceso</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    <li class="nav-item active items m-t-5">
        <a class="nav-link" href="#">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-house-medical-circle-check text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span>Gestionar</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    <li class="nav-item active items m-t-5">
        <a class="nav-link" href="#">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-folder-open text-center" style="font-size: 25px;"></i>
                <div Class="text-center"><span style="line-height: 10px;">Consultar<br>pacientes</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    <li class="nav-item active items m-t-5">
        <a class="nav-link" href="#">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-user-doctor text-center" style="font-size: 30px;"></i>
                <div Class="text-center"><span>Administracion</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>
    <li class="nav-item active items m-t-5">
        <a class="nav-link" href="#">
            <div class="d-flex flex-column ">
                <i class="fa-solid fa-clipboard text-center" style="font-size: 30px;"></i>
                <div Class="text-center"><span>Reportes</span></div>
            </div>
            <hr class="sidebar-divider">
        </a>
    </li>


</ul>
