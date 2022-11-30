<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

use App\Exports\InasistidosExport;

use App\Models\tipos_proceso;
use App\Models\departamento;
use App\Models\paciente;

class ReportePersonalizadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index_personalizado(){
        $tipos_procesos = tipos_proceso::where('tpp_estado', '=', '1')->get();
        $departamentos = departamento::where('dep_estado', '=', '1')->get();

        return view('reportes.personalizados', compact('tipos_procesos', 'departamentos'));
    }

    function get_reporte(request $request){

        $tpp_id = $request->tipo_proceso;
        $dep_id = $request->departamento;

        $fecha_ini = $request->rep_fecha_ini;
        $fecha_fin = $request->rep_fecha_fin;

        if($tpp_id == 1){

            $sql_pacientes = "SELECT tin.tin_nombre, ina.ina_medico_especialidad,  tin.tin_nombre, pro.*
            FROM cargues AS car
            INNER JOIN procesos AS pro ON pro.car_id = car.car_id
            INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
            INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
            LEFT JOIN tipos_inasistencias AS tin ON tin.tin_id = ina.ina_motivo_inasistencia
            WHERE car.car_estado = 1
            AND car.tpp_id = ".$tpp_id."
            AND pac.dep_id = ".$dep_id."
            AND car.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

            $pacientes = DB::select($sql_pacientes);

            if(count($pacientes) == 0){
                return back()->with('mDanger', 'No hay pacientes entre el '.$fecha_ini.' y el '.$fecha_fin.'!');
            }

            $ina_data = $this->proceso_inasistidos($tpp_id, $dep_id, $fecha_ini, $fecha_fin);
            return Excel::download(new InasistidosExport($ina_data), 'INA_'.$fecha_ini.'_'.$fecha_fin.'_REPORTE.xlsx');

        }else if($tpp_id == 4){
            dd('hospitalizados');

            

        }else{
            dd('Erro');
        }

    }

    public function proceso_inasistidos($tpp_id, $dep_id, $fecha_ini, $fecha_fin){

        $sql_pacientes = "SELECT tin.tin_nombre, ina.ina_medico_especialidad,  tin.tin_nombre, pro.*
        FROM cargues AS car
        INNER JOIN procesos AS pro ON pro.car_id = car.car_id
        INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
        INNER JOIN inasistidos AS ina ON ina.pro_id = pro.pro_id
        LEFT JOIN tipos_inasistencias AS tin ON tin.tin_id = ina.ina_motivo_inasistencia
        WHERE car.car_estado = 1
        AND car.tpp_id = ".$tpp_id."
        AND pac.dep_id = ".$dep_id."
        AND car.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

        $pacientes = DB::select($sql_pacientes);

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

            if($v != 0){
                for ($i=1; $i < count($gestiones)+1; $i++) {

                    $registro["SEGUIMIENTO ".$i] = $gestiones[$v]->tge_nombre;
                    $registro["FECHA DE SEGUIMIENTO ".$i] = $gestiones[$v]->ges_fecha;
                    $v -= 1;
                }
            }

            $registro["MOTIVO DE INASISTENCIA"] = $pacientes[$l2]->tin_nombre;

            $data[] = $registro;

            /* dd($data, $registro, $pacientes, $sql_gestiones); */

            $l2 += 1;
        }

        return $data;

    }

}
