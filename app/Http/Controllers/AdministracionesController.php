<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdministracionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        return view('administracion.index');
    }
}
