<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\agente;
use App\Models\gestione;
use App\Models\tipos_gestione;
use App\Models\seguimiento;
use App\Models\reprogramacione;

class GestionesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    function index($id_user){

        $validator = agente::where('user_id', $id_user)->count();

        if($validator == 0){
            return redirect()->back();
        }

        $agente = agente::where('user_id', $id_user)->get();

        $sql = "SELECT pac.pac_id, pro.pro_id, pro.pro_prioridad, pac.pac_primer_nombre,
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
        AND pra.age_id = ".$agente[0]->age_id."
        ORDER BY pro.pro_prioridad ASC";

        $gestiones = DB::select($sql);

        $tipo_procesos = tipos_gestione::where('tge_estado', '=', '1')->get();

        return view('gestionar.index', compact('gestiones', 'tipo_procesos'));
    }

    /* MODALES AJAX */

    public function modal_proceso(request $request){

        $sql = "SELECT tpp.tpp_id, tpp.tpp_nombre, car.car_activo, car.car_mes, car.car_fecha_cargue, car.car_fecha_reporte
        FROM proceso_agentes AS pra
        INNER JOIN agentes AS age ON age.age_id = pra.age_id
        INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id
        WHERE pra.pag_estado = 1
        AND car.car_estado = 1
        AND pac.pac_id = ".$request->pac_id;

        $data = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "data" => $data
            )
        );

    }

    public function modal_perfil(request $request){

        $sql1 = "SELECT tpp.tpp_id, tpp.tpp_nombre, car.car_mes,
        car.car_fecha_cargue, ges.ges_fecha, age.age_id, usu.name,
        ges.tge_id, tge.tge_nombre, ges.ges_comentario
        FROM gestiones AS ges
        INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id
        INNER JOIN agentes AS age ON age.age_id = ges.age_id
        INNER JOIN users AS usu ON usu.id = age.user_id
        INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
        WHERE ges.ges_estado = 1
        AND pro.pro_estado = 1
        AND car.car_estado = 1
        AND pac.pac_id = ".$request->pac_id;

        $sql2 = "SELECT tip.tip_alias, tip.tip_nombre, dep.dep_nombre, mun.mun_nombre, pac.*
        FROM pacientes AS pac
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        WHERE pac.pac_id = ".$request->pac_id;

        $data = DB::select($sql1);

        $paciente = DB::select($sql2);


        echo json_encode(
            array(
                'success' => true,
                'data' => $data,
                'paciente' => $paciente
            )
        );

    }

    public function modal_gestion(request $request){

        $sql1 = "SELECT tpp.tpp_id, tpp.tpp_nombre, car.car_mes,
        car.car_fecha_cargue, ges.ges_fecha, age.age_id, usu.name,
        ges.ges_comentario, tge.tge_id, tge.tge_nombre
        FROM gestiones AS ges
        INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id
        INNER JOIN agentes AS age ON age.age_id = ges.age_id
        INNER JOIN users AS usu ON usu.id = age.user_id
        INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
        WHERE ges.ges_estado = 1
        AND pro.pro_estado = 1
        AND car.car_estado = 1
        AND pro.pro_id = ".$request->pro_id;

        /* $sql2 = ""; */

        $data = DB::select($sql1);

        $sql2 = "SELECT tip.tip_alias, tip.tip_nombre, dep.dep_nombre, mun.mun_nombre, pac.*
        FROM pacientes AS pac
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        WHERE pac.pac_id = ".$request->pac_id;

        $paciente = DB::select($sql2);

        $parte1 = "SELECT pro.pro_id, car.car_id, pro.pac_id, pro.pro_prioridad, car.car_fecha_cargue, car.car_mes, car.car_fecha_reporte,
        tpp.tpp_id, tpp.tpp_nombre, ";

        $parte3 = " FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id";

        $parte5 = " WHERE pro.pro_id = ".$request->pro_id;

        switch ($request->tpp_id) {
            case 1:
                /* INASISTIDOS */

                $parte2 = " ina.*";
                $parte4 = " INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $parte2 = " seg.*";
                $parte4 = " INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id";


                break;
            case 3:
                /* RECORDATORIOS */

                $parte2 = " rec.*";
                $parte4 = " INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id";


                break;
            case 4:
                /* HOSPITALIZADOS */

                $parte2 = " hos.*";
                $parte4 = " INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id";

                break;
            case 5:
                /* BRIGADA */

                $parte2 = " bri.*";
                $parte4 = " INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id";

                break;
            case 6:
                /* REPROGRAMACION */

                $parte2 = " rep.*";
                $parte4 = " INNER JOIN reprogramacion AS rep ON rep.pro_id = pro.pro_id";

                break;
            default:

                $filtro_sql = "";

                break;
        }

        $sql3 = $parte1.$parte2.$parte3.$parte4.$parte5;

        $proceso = DB::select($sql3);

        echo json_encode(
            array(
                'success' => true,
                'data' => $data,
                'paciente' => $paciente,
                'proceso' => $proceso
            )
        );

    }

    public function post_gestion(request $request){

        $tpp_id = $request->tpp_id;

        $age_id = agente::where('user_id', '=' ,$request->usu_id)->get();

        $gestion = new gestione();
        $gestion->pac_id = $request->pac_id;
        $gestion->tge_id = $request->tge_id;
        $gestion->ges_comentario = $request->ges_comentario;
        $gestion->pro_id = $request->pro_id;
        $gestion->age_id = $age_id[0]->age_id;
        $gestion->save();

        if($tpp_id == 6){
            seguimiento::where('pro_id', $request->pro_id)->update(['sdi_fecha_cita' => $request->fecha_cita]);
        }
        if($tpp_id == 2){
            reprogramacione::where('pro_id', $request->pro_id)->update(['rep_nueva_cita' => $request->fecha_cita]);
        }

        return redirect()->back();
    }

}
