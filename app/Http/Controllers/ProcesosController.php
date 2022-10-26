<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cargue;
use App\Models\proceso;
use App\Models\agente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProcesosController extends Controller
{
    function index(){
        return view('administrar_procesos.index');
    }


    /* AJAX */
    function index_tabla(){

        $sql = "SELECT car.car_id, car.car_fecha_cargue, car.car_mes, car.car_fecha_reporte, tpp.tpp_id, tpp.tpp_nombre, car.car_activo
        FROM cargues AS car
        INNER JOIN tipos_procesos AS tpp ON car.tpp_id = tpp.tpp_id
        WHERE car.car_estado = 1";

        $cargues = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "cargues" => $cargues
            )
        );

    }

    function actualizar_estado(request $request) {

        cargue::where('car_id', $id)->update(['car_activo' => $request->estado]);

        return redirect()->back();

    }

    function modal_tabla_index(request $request){

        $agentes = agente::where('age_estado', '=', '1')->get();

        $sql = "";

        $tpp_id = $request->tpp_id;

        if($tpp_id == 1 || $tpp_id == 6 || $tpp_id == 3 || $tpp_id == 2 || $tpp_id == 5){

        }


        echo json_encode(
            array(
                "success" => true,
                "agentes" => $agentes
            )
        );


    }



}
