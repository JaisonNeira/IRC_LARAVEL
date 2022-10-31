<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\agente;

class GestionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index($id_user){

        $validator = agente::where('user_id', $id_user)->count();



        if($validator == 0){
            return redirect()->back();
        }

        $agente = agente::where('user_id', $id_user)->get();

        $sql = "SELECT pro.pro_id, pro.pro_prioridad, pac.pac_primer_nombre,
        pac.pac_segundo_nombre, pac.pac_primer_apellido, pac.pac_segundo_apellido,
        pac.pac_telefono, tpp.tpp_id, tpp.tpp_nombre
        FROM proceso_agentes AS pra
        INNER JOIN agentes AS age ON age.age_id = pra.age_id
        INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id
        WHERE pra.pag_estado = 1
        AND car.car_activo = 'SI'
        AND car.car_estado = 1
        AND pra.age_id = ".$agente[0]->age_id;

        $gestiones = DB::select($sql);

        return view('gestionar.index', compact('gestiones'));
    }
}
