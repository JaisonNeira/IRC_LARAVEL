<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PacientesController extends Controller
{
    function index(){
        return view('consultar-pacientes.index');
    }

}
