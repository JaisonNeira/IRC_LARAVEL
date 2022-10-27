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

        $sql = "SELECT car.car_id, car.car_fecha_cargue, car.car_mes, car.car_fecha_reporte, tpp.tpp_id, tpp.tpp_nombre, car.car_activo
        FROM cargues AS car
        INNER JOIN tipos_procesos AS tpp ON car.tpp_id = tpp.tpp_id
        WHERE car.car_estado = 1";

        $cargues = DB::select($sql);

        $agentes = agente::where('age_estado', '=', '1')->get();

        return view('administrar_procesos.index', compact('cargues', 'agentes'));
    }


    /* AJAX */
/*     function index_tabla(){

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

    } */

    function actualizar_estado(request $request) {

        $id = $request->car_id;

        $cargue = cargue::where('car_id', $id)->get();

        if($cargue[0]->car_estado == 1){
            cargue::where('car_id', $id)->update(['car_estado' => 0]);
            $e = 0;
        }else if($cargue[0]->car_estado == 0){
            cargue::where('car_id', $id)->update(['car_estado' => 1]);
            $e = 1;
        }else{
            echo json_encode(
                array(
                    "success" => false,
                    "estado" => "error!"
                )
            );
        }

        echo json_encode(
            array(
                "success" => true,
                "estado" => $e
            )
        );

    }


    /* COMBOBOX */
    public function dep_conv(request $request){

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT ina.ina_convenio
                FROM procesos AS pro
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY ina.ina_convenio";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT seg.seg_convenio
                FROM procesos AS pro
                INNER JOIN seguimientos AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY seg.seg_convenio";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT rec.rec_convenio
                FROM procesos AS pro
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY rec.rec_convenio";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT hos.hos_convenio
                FROM procesos AS pro
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY hos.hos_convenio";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT bri.bri_convenio
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY bri.bri_convenio";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT rep.rep_convenio
                FROM procesos AS pro
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY rep.rep_convenio";

                break;
            default:

                break;
        }

        $convenios = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "convenios" => $convenios
            )
        );

    }

    public function con_pro(request $request){

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY pro.pro_progr";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT seg.seg_convenio
                FROM procesos AS pro
                INNER JOIN seguimientos AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY seg.seg_convenio";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT rec.rec_convenio
                FROM procesos AS pro
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY rec.rec_convenio";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT hos.hos_convenio
                FROM procesos AS pro
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY hos.hos_convenio";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT bri.bri_convenio
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY bri.bri_convenio";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT rep.rep_convenio
                FROM procesos AS pro
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                GROUP BY rep.rep_convenio";

                break;
            default:

                break;
        }

        $programas = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "programas" => $programas
            )
        );

    }

    public function pro_Esp_mas(request $request){

        $sql = "SELECT c.CAM_ID, c.CAM_NOMBRE
        FROM contratos co
        INNER JOIN campanas c
        WHERE co.CON_ESTADO = 1
        AND co.CAM_ID = c.CAM_ID
        AND co.CLI_ID = ".$request->CLI_ID;

        $campana = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "campana" => $campana
            )
        );

    }

    public function esp_mun(request $request){

        $sql = "SELECT c.CAM_ID, c.CAM_NOMBRE
        FROM contratos co
        INNER JOIN campanas c
        WHERE co.CON_ESTADO = 1
        AND co.CAM_ID = c.CAM_ID
        AND co.CLI_ID = ".$request->CLI_ID;

        $campana = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "campana" => $campana
            )
        );

    }


}
