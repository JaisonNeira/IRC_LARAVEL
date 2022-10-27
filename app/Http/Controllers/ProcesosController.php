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
    function actualizar_estado(request $request) {

        $id = $request->car_id;

        $cargue = cargue::where('car_id', $id)->get();

        if($cargue[0]->car_activo == "SI"){
            cargue::where('car_id', $id)->update(['car_activo' => "NO"]);
            $e = "NO";
        }else if($cargue[0]->car_activo == "NO"){
            cargue::where('car_id', $id)->update(['car_activo' => "SI"]);
            $e = "SI";
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
        $convenio = $request->convenio;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND ina.ina_convenio_nombre = ".$convenio."
                GROUP BY pro.pro_progr";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN seguimientos AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND seg.sdi_convenio = ".$convenio."
                GROUP BY pro.pro_programa";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND rec.rec_convenio = ".$convenio."
                GROUP BY pro.pro_programa";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND rec.rec_convenio = ".$convenio."
                GROUP BY pro.pro_programa";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND bri.bri_convenio = ".$convenio."
                GROUP BY pro.pro_programa";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT pro.pro_programa
                FROM procesos AS pro
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND rep.rep_convenio = ".$convenio."
                GROUP BY pro.pro_programa";

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

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $programa = $request->programa;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT ina.ina_medico_especialidad
                FROM procesos AS pro
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND pro.pro_programa = '".$pro_programa."'
                GROUP BY ina.ina_medico_especialidad";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT seg.sdi_especialidad
                FROM procesos AS pro
                INNER JOIN seguimientos AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND pro.pro_programa = '".$pro_programa."'
                GROUP BY seg.sdi_especialidad";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT rec.rec_especialidad
                FROM procesos AS pro
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND pro.pro_programa = '".$pro_programa."'
                GROUP BY rec.rec_especialidad";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT bri.bri_especialidad
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND pro.pro_programa = '".$pro_programa."'
                GROUP BY bri.bri_especialidad";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT rep.rep_especialidad
                FROM procesos AS pro
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND pro.pro_programa = '".$pro_programa."'
                GROUP BY rep.rep_especialidad";

                break;
            default:

                break;
        }

        $especialidad = DB::select($sql);


        echo json_encode(
            array(
                "success" => true,
                "especialidad" => $especialidad
            )
        );

    }

    public function esp_mun(request $request){

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $especialidad = $request->especialidad;

        switch ($tpp_id) {
            case 2:
                /* INASISTIDOS */

                $sql = "SELECT mun.mun_id, mun.mun_nombre
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id."
                AND bri.bri_especialidad = '".$especialidad."'
                GROUP BY mun.mun_id, mun.mun_nombre";

                break;
            default:

                break;
        }

        $especialidad = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "especialidad" => $especialidad
            )
        );

    }


}
