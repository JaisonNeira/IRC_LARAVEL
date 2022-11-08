<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\paciente;
use App\Models\departamento;
use App\Models\municipio;

class PacientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){

        $pacientes = paciente::where('pac_estado', '=', '1')->get();

        $departamentos = departamento::all();

        return view('consultar-pacientes.index', compact('pacientes', 'departamentos'));

    }

}
