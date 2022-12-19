<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cargue;
use App\Models\proceso;
use App\Models\agente;
use App\Models\proceso_agente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class GestionamientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $agente = agente::where('user_id', '=', $id)->get('age_id');

        $sql = "SELECT car.car_id, car.car_mes, acc.Acc_nombre, tpp.tpp_id, pra.age_id, tpp.tpp_nombre
        FROM proceso_agentes AS pra
        INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN actas_cargues AS acc ON acc.car_id = car.car_id
        INNER JOIN tipos_procesos AS tpp ON tpp.tpp_id = car.tpp_id
        WHERE pra.age_id = ".$agente[0]->age_id."
        AND car.car_activo = 'SI'
        GROUP BY acc.Acc_nombre, car.car_id, car.car_mes, tpp.tpp_id, tpp.tpp_nombre, pra.age_id";

        $cargues = DB::select($sql);

        return view('gestionamiento.index', compact('id', 'cargues'));
    }

    /* EXCELS VISTAS */
    public function bri_vista($id){

        $user_id = Auth::user()->id;
        $agente = agente::where('user_id', '=', $user_id)->get('age_id');

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias,
        pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, bri.bri_id, bri.bri_fecha,
        bri.bri_convenio, bri.bri_punto_acopio, bri.bri_especialidad, bri.bri_fecha_ultimo_control, bri.bri_dias_transcurrido,
        bri.bri_fecha_cita
        FROM proceso_agentes AS pra
        INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND pra.age_id = ".$agente[0]->age_id."
        AND car.car_id = ".$id;

        $procesos = DB::select($sql);
        $total = count($procesos);

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM proceso_agentes AS pra
            INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pra.age_id = ".$agente[0]->age_id."
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = ".$agente[0]->age_id."
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM proceso_agentes AS pra
            INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pra.age_id = ".$agente[0]->age_id."
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);

        /* BRIGADAS */
        //Convenio
        $convenios = $this->combo_convenio($id, $agente,  5);
        //Especialidad
        $especialidades = $this->combo_especialidad($id, $agente, 5);

        //Punto Acopio
        $sql_punto_bri = "SELECT bri.bri_punto_acopio as punto_acopio
            FROM proceso_agentes AS pra
            INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
            INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            WHERE pro.pro_estado = 1
            AND pra.age_id = ".$agente[0]->age_id."
            AND pro.car_id = ".$id." GROUP BY bri.bri_punto_acopio";

        $puntos_acopio = DB::select($sql_punto_bri);

        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 5;

        return view('gestionamiento.excel.bri', compact('id', 'tpp_id', 'agentes', 'procesos', 'total', 'municipios', 'prioridades', 'departamentos', 'convenios', 'especialidades', 'puntos_acopio'));
    }

    public function cap_vista($id){

        $user_id = Auth::user()->id;
        $agente = agente::where('user_id', '=', $user_id)->get('age_id');

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad,
        tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre
        FROM proceso_agentes AS pra
        INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND pra.age_id = ".$agente[0]->age_id."
        AND car.car_id = ".$id;

        $procesos = DB::select($sql);
        $total = count($procesos);

        //Municipio
        $sql2 = "SELECT mun.mun_id, mun.mun_nombre
            FROM proceso_agentes AS pra
            INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pro.pro_estado = 1
            AND pra.age_id = ".$agente[0]->age_id."
            AND pro.car_id = ".$id.' GROUP BY mun.mun_id, mun.mun_nombre';
        $municipios = DB::select($sql2);

        //Prioridad
        $sql3 = "SELECT pro.pro_prioridad
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = ".$agente[0]->age_id."
                AND pro.car_id =".$id.' GROUP BY pro.pro_prioridad';
        $prioridades = DB::select($sql3);

        //Departamento
        $sql4 = "SELECT dep.dep_id, dep.dep_nombre
            FROM proceso_agentes AS pra
            INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            WHERE pro.pro_estado = 1
            AND pra.age_id = ".$agente[0]->age_id."
            AND pro.car_id = ".$id.' GROUP BY dep.dep_id, dep.dep_nombre';
        $departamentos = DB::select($sql4);


        $sql5 = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1";

        $agentes = DB::select($sql5);

        $tpp_id = 7;

        return view('gestionamiento.excel.cap', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'departamentos', 'municipios', 'prioridades'));
    }

    public function rec_vista($id){

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
         pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rec.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id;

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

        return view('gestionamiento.excel.rec', compact('procesos', 'id', 'total', 'tpp_id', 'agentes', 'convenios', 'fecha_cita', 'medicos', 'especialidades', 'departamentos', 'municipios', 'prioridades'));
    }

    public function ina_vista($id){

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, ina.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id;

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

        return view('gestionamiento.excel.ina', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'medicos', 'especialidades', 'convenios', 'departamentos', 'municipios', 'prioridades'));
    }

    public function rep_vista($id){

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rep.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id;

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

        return view('gestionamiento.excel.rep', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'especialidades', 'convenios', 'departamentos', 'municipios', 'prioridades'));
    }

    public function hos_vista($id){

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, hos.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id;

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

        return view('gestionamiento.excel.hos', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'programas', 'departamentos', 'municipios', 'prioridades'));
    }

    public function seg_vista($id){

        $sql = "SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id,
        pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, seg.*
        FROM procesos AS pro
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
        INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
        INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
        WHERE pro.pro_estado = 1
        AND car.car_id = ".$id;

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

        return view('gestionamiento.excel.seg', compact('procesos', 'total', 'tpp_id', 'id', 'agentes', 'especialidades', 'departamentos', 'municipios', 'prioridades'));
    }

    /* FUNCIONES VISTAS EXCEL */
    public function combo_convenio($id, $agente, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_conv_ina = "SELECT ina.ina_convenio_nombre as convenio
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id = ".$id.' GROUP BY ina.ina_convenio_nombre';

                $convenios = DB::select($sql_conv_ina);
                break;
            case 5:
                $sql_conv_bri = "SELECT bri.bri_convenio as convenio
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id = ".$id.' GROUP BY bri.bri_convenio';
                $convenios = DB::select($sql_conv_bri);
                break;
            case 3:
                $sql_conv_reco = "SELECT rec.rec_convenio as convenio
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id = ".$id.' GROUP BY rec.rec_convenio';
                $convenios = DB::select($sql_conv_reco);
                break;
            case 6:
                $sql_conv_rep = "SELECT rep.rep_convenio as convenio
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id = ".$id.' GROUP BY rep.rep_convenio';
                $convenios = DB::select($sql_conv_rep);
                break;

            default:
                break;
        }
        return $convenios;
    }

    public function combo_especialidad($id, $agente, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_espe_ina = "SELECT ina.ina_medico_especialidad as especialidad
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY ina.ina_medico_especialidad';
                $especialidad = DB::select($sql_espe_ina);
                break;
            case 2:
                $sql_espe_seg = "SELECT seg.sdi_especialidad as especialidad
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY seg.sdi_especialidad';
                $especialidad = DB::select($sql_espe_seg);
                break;
            case 3:
                $sql_espe_reco = "SELECT rec.rec_especialidad as especialidad
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY rec.rec_especialidad';
                $especialidad = DB::select($sql_espe_reco);
                break;
            case 5:
                $sql_espe_bri = "SELECT bri.bri_especialidad as especialidad
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id = ".$id.' GROUP BY bri.bri_especialidad';
                $especialidad = DB::select($sql_espe_bri);
                break;
            case 6:
                $sql_espe_repo = "SELECT rep.rep_especialidad as especialidad
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY rep.rep_especialidad';
                $especialidad = DB::select($sql_espe_repo);
                break;

            default:
                break;
        }
        return $especialidad;
    }

    public function combo_medico($id, $agente, $tpp_id){
        switch ($tpp_id) {
            case 1:
                $sql_espe_ina = "SELECT ina.ina_medico_nombre as medico_nombre
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY ina.ina_medico_nombre';
                $medicos = DB::select($sql_espe_ina);
                break;
            case 3:
                $sql_espe_reco = "SELECT rec.rec_profesional as medico_nombre
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = ".$agente[0]->age_id."
                    AND pro.car_id =".$id.' GROUP BY rec.rec_profesional';
                $medicos = DB::select($sql_espe_reco);
                break;
            default:
                break;
        }
        return $medicos;
    }

    /* FILTRO */
    public function filtro_excel_gestiones(request $request){

        $user_id = Auth::user()->id;
        $agente = agente::where('user_id', '=', $user_id)->get('age_id');

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

                $filtro_sql = 'SELECT pro.pro_gestionado, pro.id_user_gestion, pro.car_id, pro.pro_id, pro.pro_prioridad,
                tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, ina.*
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
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
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND seg.sdi_especialidad LIKE "%'.$esp.'%"';

                break;
            case 3:
                /* RECORDATORIOS */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, rec.*
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN recordatorios AS rec ON rec.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
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
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN hospitalizados AS hos ON hos.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
                AND car.car_id ='.$car_id.'
                AND pac.mun_id LIKE "%'.$mun.'%"
                AND pac.dep_id LIKE "%'.$dep.'%"
                AND pro.pro_prioridad LIKE "%'.$pri.'%"
                AND hos.hos_programa LIKE "%'.$pro.'%"';

                break;
            case 5:
                /* BRIGADA */

                $filtro_sql = 'SELECT pro.car_id, pro.pro_id, pro.pro_prioridad, tip.tip_alias, pac.pac_id, pac.pac_identificacion, pac.pac_nombre_completo, dep.dep_nombre, mun.mun_nombre, bri.bri_id, bri.bri_fecha, bri.bri_convenio, bri.bri_punto_acopio,
                bri.bri_especialidad, bri.bri_fecha_ultimo_control, bri.bri_dias_transcurrido, bri.bri_fecha_cita
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN brigadas AS bri ON bri.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
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
                FROM proceso_agentes AS pra
                INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN reprogramaciones AS rep ON rep.pro_id = pro.pro_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                WHERE pro.pro_estado = 1
                AND pra.age_id = '.$agente[0]->age_id.'
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
                    FROM proceso_agentes AS pra
                    INNER JOIN procesos AS pro ON pro.pro_id = pra.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                    INNER JOIN tipos_identificaciones AS tip ON tip.tip_id = pac.tip_id
                    INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
                    INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
                    WHERE pro.pro_estado = 1
                    AND pra.age_id = '.$agente[0]->age_id.'
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
