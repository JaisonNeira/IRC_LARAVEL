<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

use App\Exports\InasistidosExport;


class AdministrarCarguesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function get_cargue(request $request, $id){

        $tpp_id = $request->tpp_id;
        $file_name = $request->file_name;

        $data = $this->Proceso($tpp_id, $id);

        dd('nashe get_cargue', $data);

        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */
                return Excel::download(new InasistidosExport($data), 'REPORTE-'.$file_name.'.xlsx');
                break;
            case 2:
                /* SEGUIMIENTOS */
                break;
            case 3:
                /* RECORDATORIOS */
                break;
            case 4:
                /* HOSPITALIZADOS */
                break;
            case 5:
                /* BRIGADA */
                break;
            case 6:
                /* REPROGRAMACION */
                break;
            case 7:
                /* REPROGRAMACION */
                break;
            default:
                dd('error');
                break;
        }


    }

    function Proceso($tpp_id, $id){
        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $data = $this->get_ina($tpp_id, $id);

                break;
            case 2:
                /* SEGUIMIENTOS */

                $data = $this->get_seg($tpp_id, $id);

                break;
            case 3:
                /* RECORDATORIOS */



                break;
            case 4:
                /* HOSPITALIZADOS */



                break;
            case 5:
                /* BRIGADA */



                break;
            case 6:
                /* REPROGRAMACION */



                break;
            case 7:
                /* REPROGRAMACION */



                break;

            default:

                $sql = "";

                break;
        }

        return $data;
    }

    function get_ina($tpp_id, $id){

        $sql_pacientes = "SELECT tin.tin_nombre,tin.tin_nombre, pro.*,
        ina.ina_medico_especialidad
        FROM cargues AS car
        INNER JOIN procesos AS pro ON pro.car_id = car.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
        LEFT JOIN tipos_inasistencias AS tin ON tin.tin_id = ina.ina_motivo_inasistencia
        WHERE car.car_estado = 1
        AND car.car_id = ".$id."
        AND car.tpp_id = ".$tpp_id;

        $pacientes = DB::select($sql_pacientes);
        $data[] = array();
        $l2 = 0;
        for ($l=0; $l < count($pacientes); $l++) {

            $pac_id = $pacientes[$l2]->pac_id;

            $paciente = DB::select("SELECT tip.tip_alias, dep.dep_nombre, mun.mun_nombre, pac.*
            FROM pacientes AS pac
            INNER JOIN tipos_identificaciones AS tip ON pac.tip_id = tip.tip_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pac_id = ".$pac_id);

            $registro = [
                "DPTO" => $paciente[0]->dep_nombre,
                "MUNICIPIO" => $paciente[0]->mun_nombre,
                "TIPO DE ID" => $paciente[0]->tip_alias,
                "NUMERO DE ID" => $paciente[0]->pac_identificacion,
                "REGIMEN" => $paciente[0]->pac_regimen_afiliacion_SGSS,
                "PRIMER NOMBRE" => $paciente[0]->pac_primer_nombre,
                "SEGUNDO NOMBRE" => $paciente[0]->pac_segundo_nombre,
                "PRIMER APELLIDO" => $paciente[0]->pac_primer_apellido,
                "SEGUNDO APELLIDO" => $paciente[0]->pac_segundo_apellido,
                "FECHA DE NACIMIENTO" => $paciente[0]->pac_fecha_nacimiento,
                "DIRECCION" => $paciente[0]->pac_direccion,
                "TELEFONICO" => $paciente[0]->pac_telefono,
                "ESPECIALIDAD" => $pacientes[$l2]->ina_medico_especialidad
            ];

            /* dd($list, $paciente[0], $registro); */

            $pro_id = $pacientes[$l2]->pro_id;

            $sql_gestiones = "SELECT tge.tge_nombre , ges.*
            FROM gestiones AS ges
            INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
            INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
            INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
            WHERE ges.ges_estado = 1
            AND ges.pro_id = ".$pro_id."
            ORDER BY ges.ges_fecha DESC
            LIMIT 3";

            $gestiones = DB::select($sql_gestiones);

            $v = count($gestiones)-1;

            $registro["SEGUIMIENTO 1"] = " ";
            $registro["FECHA DE SEGUIMIENTO 1"] = " ";
            $registro["SEGUIMIENTO 2"] = " ";
            $registro["FECHA DE SEGUIMIENTO 2"] = " ";
            $registro["SEGUIMIENTO 3"] = " ";
            $registro["FECHA DE SEGUIMIENTO 3"] = " ";

            if($v > -1){
                for ($i=1; $i < count($gestiones)+1; $i++) {

                    $registro["SEGUIMIENTO ".$i] = $gestiones[$v]->tge_nombre;
                    $registro["FECHA DE SEGUIMIENTO ".$i] = $gestiones[$v]->ges_fecha;
                    $v -= 1;
                }
            }

            $registro["MOTIVO DE INASISTENCIA"] = $pacientes[$l2]->tin_nombre;

            $data[$l2] = $registro;

            /* dd($data, $registro, $pacientes, $sql_gestiones); */

            $l2 += 1;
        }

        /* dd('nashe get_ina', $data); */

        return $data;

    }

    function get_seg($tpp_id, $id){

        $sql_pacientes = "SELECT pro.*, seg.sdi_especialidad,
        seg.sdi_fecha_ultimo_control, seg.sdi_fecha_cita
        FROM cargues AS car
        INNER JOIN procesos AS pro ON pro.car_id = car.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN seguimientos_demandas_inducidas AS seg ON seg.pro_id = pro.pro_id
        WHERE car.car_estado = 1
        AND car.car_id = ".$id."
        AND car.tpp_id = ".$tpp_id;

        $pacientes = DB::select($sql_pacientes);
        $data[] = array();
        $l2 = 0;
        for ($l=0; $l < count($pacientes); $l++) {

            $pac_id = $pacientes[$l2]->pac_id;

            $paciente = DB::select("SELECT tip.tip_alias, dep.dep_nombre, mun.mun_nombre, pac.*
            FROM pacientes AS pac
            INNER JOIN tipos_identificaciones AS tip ON pac.tip_id = tip.tip_id
            INNER JOIN departamentos AS dep ON dep.dep_id = pac.dep_id
            INNER JOIN municipios AS mun ON mun.mun_id = pac.mun_id
            WHERE pac_id = ".$pac_id);



            $registro = [
                "DPTO" => $paciente[0]->dep_nombre,
                "MUNICIPIO" => $paciente[0]->mun_nombre,
                "TIPO DE ID" => $paciente[0]->tip_alias,
                "NUMERO DE ID" => $paciente[0]->pac_identificacion,
                "REGIMEN" => $paciente[0]->pac_regimen_afiliacion_SGSS,
                "PRIMER NOMBRE" => $paciente[0]->pac_primer_nombre,
                "SEGUNDO NOMBRE" => $paciente[0]->pac_segundo_nombre,
                "PRIMER APELLIDO" => $paciente[0]->pac_primer_apellido,
                "SEGUNDO APELLIDO" => $paciente[0]->pac_segundo_apellido,
                "FECHA DE NACIMIENTO" => $paciente[0]->pac_fecha_nacimiento,
                "DIRECCION" => $paciente[0]->pac_direccion,
                "TELEFONICO" => $paciente[0]->pac_telefono,
                "ESPECIALIDAD" => $pacientes[$l2]->sdi_especialidad,
                "FECHA ULTIMO CONTROL" => $pacientes[$l2]->sdi_fecha_ultimo_control,
            ];

            /* dd($list, $paciente[0], $registro); */

            $pro_id = $pacientes[$l2]->pro_id;

            $sql_gestiones = "SELECT tge.tge_nombre , ges.*
            FROM gestiones AS ges
            INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
            INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
            WHERE ges.ges_estado = 1
            AND ges.pro_id = ".$pro_id."
            ORDER BY ges.ges_fecha DESC
            LIMIT 3";

            $gestiones = DB::select($sql_gestiones);

            $v = count($gestiones)-1;

            $registro["SEGUIMIENTO 1"] = " ";
            $registro["FECHA DE SEGUIMIENTO 1"] = " ";
            $registro["SEGUIMIENTO 2"] = " ";
            $registro["FECHA DE SEGUIMIENTO 2"] = " ";
            $registro["SEGUIMIENTO 3"] = " ";
            $registro["FECHA DE SEGUIMIENTO 3"] = " ";

            if($v > -1){
                for ($i=1; $i < count($gestiones)+1; $i++) {

                    $registro["SEGUIMIENTO ".$i] = $gestiones[$v]->tge_nombre;
                    $registro["FECHA DE SEGUIMIENTO ".$i] = $gestiones[$v]->ges_fecha;
                    $v -= 1;
                }
            }

            $ult_ges = $pacientes[$l2]->ges_id;

            $registro["FECHA NUEVA CITA"] = " ";
            
            if($ult_ges != null){
                $fecha_cita = DB::select('SELECT `ges_fecha_nueva_cita` FROM `gestiones` WHERE `ges_id` = '.$ult_ges);

                $registro["FECHA NUEVA CITA"] = $fecha_cita[0]->ges_fecha_nueva_cita;
            }

            $data[$l2] = $registro;

            /* dd($data, $registro, $pacientes, $sql_gestiones); */

            $l2 += 1;
        }

        /* dd('nashe get_ina', $data); */

        return $data;

    }

}
