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

    /* EXCELS VISTAS */
    public function bri_vista($id){
        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, bri.bri_id, bri.bri_fecha, bri.bri_convenio, bri.bri_punto_acopio,
        bri.bri_especialidad, bri.bri_fecha_ultimo_control, bri.bri_dias_transcurrido, bri.bri_fecha_cita
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* BRIGADAS */
        //Convenio
        $convenios = $this->combo_convenio($id, 5);
        //Especialidad
        $especialidades = $this->combo_especialidad($id, 5);

        //Punto Acopio
        $sql_punto_bri = "SELECT bri.bri_punto_acopio as punto_acopio
            FROM procesos AS pro
            INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            WHERE pro.pro_estado = 1
            AND pro.car_id =".$id.' GROUP BY bri.bri_punto_acopio';

        $puntos_acopio = DB::select($sql_punto_bri);

        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 5;

        return view('administrar_procesos.excel.bri', compact('id', 'tpp_id', 'agentes', 'procesos', 'total', 'municipios', 'prioridades', 'departamentos', 'convenios', 'especialidades', 'puntos_acopio'));
    }

    public function cap_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);


        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 7;

        return view('administrar_procesos.excel.cap', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'departamentos', 'municipios', 'prioridades'));
    }

    public function rec_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
         pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rec.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* RECORDATORIO */
        //Convenio
        $convenios = $this->combo_convenio($id, 3);
        //Especialidad
        $especialidades = $this->combo_especialidad($id, 3);
        //Medicos
        $medicos = $this->combo_medico($id, 3);

        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $sql6 = "SELECT rec.rec_fecha_cita
        FROM procesos AS pro
        INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        WHERE pro.pro_estado = 1
        AND pro.car_id = ".$id." GROUP BY rec.rec_fecha_cita";

        $fecha_cita = DB::select($sql6);

        $tpp_id = 3;

        return view('administrar_procesos.excel.rec', compact('procesos', 'id', 'total', 'tpp_id', 'agentes', 'convenios', 'fecha_cita', 'medicos', 'especialidades', 'departamentos', 'municipios', 'prioridades'));
    }

    public function ina_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, ina.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* INASISTIDOS */
        //Convenio
        $convenios = $this->combo_convenio($id, 1);
        //Especialidad
        $especialidades = $this->combo_especialidad($id, 1);
        //Medicos
        $medicos = $this->combo_medico($id, 1);


        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);


        $tpp_id = 1;

        return view('administrar_procesos.excel.ina', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'medicos', 'especialidades', 'convenios', 'departamentos', 'municipios', 'prioridades'));
    }

    public function rep_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rep.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* REPROGRAMACIONES */
        //Convenio
        $convenios = $this->combo_convenio($id, 6);
        //Especialidad
        $especialidades = $this->combo_especialidad($id, 6);

        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 6;

        return view('administrar_procesos.excel.rep', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'especialidades', 'convenios', 'departamentos', 'municipios', 'prioridades'));
    }

    public function hos_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, hos.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* HOSPITALISADOS */
        $sql_pro_hosp ="SELECT hos.hos_programa as programa
            FROM procesos AS pro
            INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            WHERE pro.pro_estado = 1
            AND pro.car_id =".$id.' GROUP BY hos.hos_programa';
        $programas = DB::select($sql_pro_hosp);


        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 4;

        return view('administrar_procesos.excel.hos', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'programas', 'departamentos', 'municipios', 'prioridades'));
    }

    public function seg_vista($id){

        $sql = "SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, seg.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id." LIMIT 20";

        $procesos = DB::select($sql);
        $total = proceso::where('car_id','=',$id)->count();

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM procesos AS pro
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM procesos AS pro
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* SEGUIMIENTOS */
        //Especialidad
        $especialidades = $this->combo_especialidad($id, 2);


        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 2;

        return view('administrar_procesos.excel.seg', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'especialidades', 'departamentos', 'municipios', 'prioridades'));
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

        if($agentes == null){
            return redirect()->back()->with('mDanger', 'Tiene que seleccionar por lo menos un agente!...');
        }

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $dep = $request->departamento;
        $mun = $request->municipio;
        $pri = $request->prioridad;
        $con = $request->convenio;
        $esp = $request->especialidad;
        $pro = $request->programa;
        $pa = $request->punto_de_acopio;
        $med = $request->medico;
        $fec = $request->fecha_cita;

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
                    $filtro_sql = $filtro_sql." AND ina.ina_medico_especialidad	= '".$esp."'";
                }

                if($med != ""){
                    $filtro_sql = $filtro_sql." AND ina.ina_medico_nombre = '".$med."'";
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

                if($med != ""){
                    $filtro_sql = $filtro_sql." AND rec.rec_profesional = '".$med."'";
                }

                if($fec != ""){
                    $filtro_sql = $filtro_sql." AND rec.rec_fecha_cita = '".$fec."'";
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

    /* FUNCIONES VISTAS EXCEL */
    public function combo_convenio($id, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_conv_ina = "SELECT ina.ina_convenio_nombre as convenio
                    FROM procesos AS pro
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id = ".$id.' GROUP BY ina.ina_convenio_nombre';

                $convenios = DB::select($sql_conv_ina);
                break;
            case 5:
                $sql_conv_bri = "SELECT bri.bri_convenio as convenio
                    FROM procesos AS pro
                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id = ".$id.' GROUP BY bri.bri_convenio';
                $convenios = DB::select($sql_conv_bri);
                break;
            case 3:
                $sql_conv_reco = "SELECT rec.rec_convenio as convenio
                    FROM procesos AS pro
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id = ".$id.' GROUP BY rec.rec_convenio';
                $convenios = DB::select($sql_conv_reco);
                break;
            case 6:
                $sql_conv_rep = "SELECT rep.rep_convenio as convenio
                    FROM procesos AS pro
                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id = ".$id.' GROUP BY rep.rep_convenio';
                $convenios = DB::select($sql_conv_rep);
                break;

            default:
                break;
        }
        return $convenios;
    }

    public function combo_especialidad($id, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_espe_ina = "SELECT ina.ina_medico_especialidad as especialidad
                    FROM procesos AS pro
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY ina.ina_medico_especialidad';
                $especialidad = DB::select($sql_espe_ina);
                break;
            case 2:
                $sql_espe_seg = "SELECT seg.sdi_especialidad as especialidad
                    FROM procesos AS pro
                    INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY seg.sdi_especialidad';
                $especialidad = DB::select($sql_espe_seg);
                break;
            case 3:
                $sql_espe_reco = "SELECT rec.rec_especialidad as especialidad
                    FROM procesos AS pro
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY rec.rec_especialidad';
                $especialidad = DB::select($sql_espe_reco);
                break;
            case 5:
                $sql_espe_bri = "SELECT bri.bri_especialidad as especialidad
                    FROM procesos AS pro
                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id = ".$id.' GROUP BY bri.bri_especialidad';
                $especialidad = DB::select($sql_espe_bri);
                break;
            case 6:
                $sql_espe_repo = "SELECT rep.rep_especialidad as especialidad
                    FROM procesos AS pro
                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY rep.rep_especialidad';
                $especialidad = DB::select($sql_espe_repo);
                break;

            default:
                break;
        }
        return $especialidad;
    }

    public function combo_medico($id, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_espe_ina = "SELECT ina.ina_medico_nombre as medico_nombre
                    FROM procesos AS pro
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY ina.ina_medico_nombre';
                $medicos = DB::select($sql_espe_ina);
                break;
            case 3:
                $sql_espe_reco = "SELECT rec.rec_profesional as medico_nombre
                    FROM procesos AS pro
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pro.car_id =".$id.' GROUP BY rec.rec_profesional';
                $medicos = DB::select($sql_espe_reco);
                break;
            default:
                break;
        }
        return $medicos;
    }

    public function filtro_excel(request $request){

        $tpp_id = $request->tpp_id;
        $car_id = $request->car_id;
        $dep = $request->dep_id;
        $mun = $request->mun_id;
        $pri = $request->prioridad;
        $con = $request->convenio;
        $esp = $request->especialidad;
        $pro = $request->programa;
        $pa = $request->punto_acopio;
        $med = $request->medico;
        $fec = $request->fecha_cita;

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
                pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, ina.*
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND ina.ina_convenio_nombre LIKE "%'.$con.'%"
                AND ina.ina_medico_nombre LIKE "%'.$med.'%"
                AND ina.ina_medico_especialidad LIKE "%'.$esp.'%"';

                break;
            case 2:
                /* SEGUIMIENTOS */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
                pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, seg.*
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND seg.sdi_especialidad LIKE "%'.$esp.'%"';

                break;
            case 3:
                /* RECORDATORIOS */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rec.*
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND rec.rec_fecha_cita LIKE "%'.$fec.'%"
                AND rec.rec_convenio LIKE "%'.$con.'%"
                AND rec.rec_especialidad LIKE "%'.$esp.'%"
                AND rec.rec_profesional LIKE "%'.$med.'%"';

                break;
            case 4:
                /* HOSPITALIZADOS */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
                pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, hos.*
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND hos.hos_programa LIKE "%'.$pro.'%"';

                break;
            case 5:
                /* BRIGADA */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_nombre, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, bri.bri_id, bri.bri_fecha, bri.bri_convenio, bri.bri_punto_acopio,
                bri.bri_especialidad, bri.bri_fecha_ultimo_control, bri.bri_dias_transcurrido, bri.bri_fecha_cita
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id = '.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND bri.bri_convenio LIKE "%'.$con.'%"
                AND bri.bri_especialidad LIKE "%'.$esp.'%"
                AND bri.bri_punto_acopio LIKE "%'.$pa.'%"';

                break;
            case 6:
                /* REPROGRAMACION */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
                pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rep.*
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND rep.rep_convenio LIKE "%'.$con.'%"
                AND rep.rep_profesional LIKE "%'.$med.'%"
                AND rep.rep_especialidad LIKE "%'.$esp.'%"';

                break;
            case 7:
                    /* CAPTACION */

                    $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
                    pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre
                    FROM procesos AS pro
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                    INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                    INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                    WHERE pro.pro_estado = 1
                    AND car.car_id = '.$car_id.'
                    AND pac.mun_id LIKE "%'.$mun.'%"
                    AND pac.dep_id LIKE "%'.$dep.'%"
                    AND pro.pro_prioridad LIKE "%'.$pri.'%"';

                    break;
            default:

                $filtro_sql = "";

                break;
        }

        if($filtro_sql != ""){
            $datos = DB::select($filtro_sql);

            echo json_encode(
                array(
                    "success" => true,
                    "cantidad" => count($datos),
                    "data" => $datos/* ,
                    "a" => $filtro_sql */
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

}
