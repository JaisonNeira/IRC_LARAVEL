<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdministracionesController extends Controller
{
    function index(){
        return view('administracion.index');
    }
}
