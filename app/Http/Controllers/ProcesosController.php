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
    public function filtro(request $request){

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $dep = $request->dep;
        $mun = $request->mun;
        $pri = $request->pri;
        $con = $request->con;
        $esp = $request->esp;
        $pro = $request->pro;
        $pa = $request->pa;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($con != ""){
                    $filtro_sql = $filtro_sql." AND ina.ina_convenio_nombre = '".$con."'";
                }

                if($esp != ""){
                    $filtro_sql = $filtro_sql." AND ina.ina_medico_especialidad	 = '".$esp."'";
                }

                $cant = DB::select($filtro_sql);

                break;
            case 2:
                /* SEGUIMIENTOS */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($esp != ""){
                    $filtro_sql = $filtro_sql." AND seg.sdi_especialidad = '".$esp."'";
                }


                $cant = DB::select($filtro_sql);

                break;
            case 3:
                /* RECORDATORIOS */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($con != ""){
                    $filtro_sql = $filtro_sql." AND rec.rec_convenio = '".$con."'";
                }

                if($esp != ""){
                    $filtro_sql = $filtro_sql." AND rec.rec_especialidad = '".$esp."'";
                }

                $cant = DB::select($filtro_sql);

                break;
            case 4:
                /* HOSPITALIZADOS */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($pro != ""){
                    $filtro_sql = $filtro_sql." AND hos.hos_programa = '".$esp."'";
                }

                $cant = DB::select($filtro_sql);

                break;
            case 5:
                /* BRIGADA */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($con != ""){
                    $filtro_sql = $filtro_sql." AND bri.bri_convenio = '".$con."'";
                }

                if($esp != ""){
                    $filtro_sql = $filtro_sql." AND bri.bri_especialidad = '".$esp."'";
                }

                if($pa != ""){
                    $filtro_sql = $filtro_sql." AND bri.bri_punto_acopio = '".$pa."'";;
                }


                $cant = DB::select($filtro_sql);

                break;
            case 6:
                /* REPROGRAMACION */

                $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND pro.car_id = ".$car_id;

                if($dep != ""){
                    $filtro_sql = $filtro_sql." AND pac.dep_id = ".$dep;
                }

                if($mun != ""){
                    $filtro_sql = $filtro_sql." AND pac.mun_id = ".$mun;
                }

                if($pri != ""){
                    $filtro_sql = $filtro_sql." AND pro.pro_prioridad = ".$pri;
                }

                if($con != ""){
                    $filtro_sql = $filtro_sql." AND rep.rep_convenio = '".$con."'";
                }

                if($esp != ""){
                    $filtro_sql = $filtro_sql." AND rep.rep_especialidad = '".$esp."'";
                }

                $cant = DB::select($filtro_sql);

                break;
            default:

                $filtro_sql = "";

                break;
        }

        if($filtro_sql != ""){
            $convenios = DB::select($filtro_sql);

            echo json_encode(
                array(
                    "success" => true,
                    "cantidad" => $convenios[0]->cantidad
                )
            );
        }else{
            echo json_encode(
                array(
                    "success" => false,
                    "error" => "tpp_id no valido!"
                )
            );
        }



    }

    public function asignar_segmentar(request $request){



    }


}
