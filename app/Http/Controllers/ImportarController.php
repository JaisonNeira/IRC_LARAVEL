<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\tipos_proceso;

class ImportarController extends Controller
{


    function index(){
        $tipos_procesos = tipos_proceso::where('tpp_estado', '=','1')->get();

        return view('importar.index', compact('tipos_procesos'));
    }

    function importar(request $request){

        $request->validate([
            'Tipo_proceso' => 'required',
            'file' => 'required'
        ]);




    }

}
