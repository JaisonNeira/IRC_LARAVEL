<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cargue;
use App\Models\proceso;
use App\Models\agente;
use App\Models\proceso_agente;
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

        $sql2 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql2);

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
            case 7:
                    /* CAPTACION */

                    $filtro_sql = "SELECT COUNT(pro.pro_id) AS cantidad
                    FROM procesos AS pro
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

                    $cant = DB::select($filtro_sql);

                    break;
            default:

                $filtro_sql = "";

                break;
        }

        if($filtro_sql != ""){
            $cantidad = DB::select($filtro_sql);

            echo json_encode(
                array(
                    "success" => true,
                    "cantidad" => $cantidad[0]->cantidad
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

        $agentes = $request->ids;

        /* if($agentes == null){
            return redirect()->back()->with('warmessage', 'Tiene que seleccionar por lo menos un agente!...');
        } */

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $dep = $request->departamento;
        $mun = $request->municipio;
        $pri = $request->prioridad;
        $con = $request->convenio;
        $esp = $request->especialidad;
        $pro = $request->programa;
        $pa = $request->punto_de_acopio;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $filtro_sql = "SELECT pro.pro_id
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

                $filtro_sql = "SELECT pro.pro_id
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

                $filtro_sql = "SELECT pro.pro_id
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

                $filtro_sql = "SELECT pro.pro_id
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

                $filtro_sql = "SELECT pro.pro_id
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

                $filtro_sql = "SELECT pro.pro_id
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
            case 7:
                    /* CAPTACION */

                    $filtro_sql = "SELECT pro.pro_id
                    FROM procesos AS pro
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

                    $cant = DB::select($filtro_sql);

                    break;
            default:

                $filtro_sql = "";

                break;
        }
        if($filtro_sql != ""){
            $procesos = DB::select($filtro_sql);

            for ($i=0; $i < count($procesos); $i++) {

                for ($e = 0; $e < count($agentes); $e++) {
                    $asignaciones[] = array(
                        "pro_id" => $procesos[$i]->pro_id,
                        "age_id" => $agentes[$e]
                    );
                }

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
        }else{
            return redirect()->back()->with('mDanger', 'Error en la asignacion!...');
        }


    }


}
