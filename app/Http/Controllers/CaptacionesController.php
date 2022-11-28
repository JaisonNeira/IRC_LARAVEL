<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\proceso_agente;

class CaptacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $sql = "SELECT car.car_id
        FROM cargues AS car
        WHERE car.car_estado = 1
        AND car.tpp_id = 7
        AND car.sys = 1
        ORDER BY car.created_at DESC LIMIT 1";

        $ult_carg = DB::select($sql);

        if(count($ult_carg) != 0){
            $car_id = $ult_carg[0]->car_id;
        }else{
            $car_id = 0;
        }

        $sql2 = "SELECT pro.pro_id, pro.car_id ,pro.pro_prioridad, pac.*
        FROM procesos AS pro
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        WHERE pro.pro_estado = 1
        AND pro.car_id = ".$car_id;

        $procesos = DB::select($sql2);

        $sql3 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql3);

        return view('captaciones.index', compact('procesos', 'agentes'));

    }

    public function asignar(request $request){


        $agentes = $request->ids;

        if($agentes == null){
            return redirect()->back()->with('warmessage', 'Tiene que seleccionar por lo menos un agente!...');
        }

        for ($e = 0; $e < count($agentes); $e++) {
            $asignaciones[] = array(
                "pro_id" => $request->pro_id,
                "age_id" => $agentes[$e]
            );
        }

        for ($o=0; $o < count($asignaciones); $o++) {

            $validador = proceso_agente::where('pro_id', $asignaciones[$o]["pro_id"])->where('age_id', $asignaciones[$o]["age_id"])->count();

            if($validador == 0){
                $asignacion = new proceso_agente();
                $asignacion->pro_id = $asignaciones[$o]["pro_id"];
                $asignacion->age_id = $asignaciones[$o]["age_id"];
                $asignacion->save();
            }

        }

        return redirect()->back()->with('mSucces', 'Asignacion correcta!...');
    }

}
