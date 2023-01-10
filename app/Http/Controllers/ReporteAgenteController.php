<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

use App\Models\agente;

class ReporteAgenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_reporte(request $request, $age_id){

        $sql_cargues = "SELECT car.car_id, car.car_fecha_cargue, acc.Acc_nombre
        FROM proceso_agentes AS pag
        INNER JOIN procesos AS pro ON pro.pro_id = pag.pro_id
        INNER JOIN cargues AS car ON car.car_id = pro.car_id
        INNER JOIN actas_cargues AS acc ON acc.car_id = car.car_id
        WHERE pag.pag_estado = 1
        AND car.car_estado = 1
        AND pag.age_id = ".$age_id."
        GROUP BY car.car_id, acc.Acc_nombre, car.car_fecha_cargue";

        $cargues_asig = DB::select($sql_cargues);

        if($cargues_asig == null){
            return redirect()->back()->with('mDanger', 'Este agente no se le ha asignado en ningun archivo!');
        }

        $a = 0;
        foreach ($cargues_asig as $cargue) {

            $data_report[$a]['fecha'] = $cargue->car_fecha_cargue;
            $data_report[$a]['archivo'] = $cargue->Acc_nombre;

            /* CANTIDAD DE ASIGNACION */

            $sql_pro_asig = "SELECT COUNT(pag.pag_id) AS cant_pro_asig
            FROM proceso_agentes AS pag
            INNER JOIN procesos AS pro ON pro.pro_id = pag.pro_id
            INNER JOIN cargues AS car ON car.car_id = pro.car_id
            INNER JOIN actas_cargues AS acc ON acc.car_id = car.car_id
            WHERE pag.pag_estado = 1
            AND car.car_estado = 1
            AND pag.age_id = ".$age_id."
            AND car.car_id = ".$cargue->car_id;

            $pro_asig = DB::select($sql_pro_asig);

            $pro_asig_count = count($pro_asig);

            $data_report[$a]['asignados'] = $pro_asig[0]->cant_pro_asig;


            $sql_ges_realiz = "SELECT ges.pro_id
            FROM gestiones AS ges
            INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
            INNER JOIN cargues AS car ON car.car_id = pro.car_id
            INNER JOIN actas_cargues AS acc ON acc.car_id = car.car_id
            WHERE ges.ges_estado = 1
            AND car.car_estado = 1
            AND ges.age_id = ".$age_id."
            AND car.car_id = ".$cargue->car_id."
            GROUP BY ges.pro_id";

            $ges = DB::select($sql_ges_realiz);

            $ges_count = count($ges);

            $data_report[$a]['gestionados'] = $ges_count;

            $data_report[$a]['faltantes'] = intval($pro_asig[0]->cant_pro_asig) - intval($ges_count);

            $data_report[$a]['cumplimiento'] = round((intval($ges_count)*100)/intval($pro_asig[0]->cant_pro_asig))."%";

            $a++;
            /* dd(); */
        }

        $sql_agente_data = "SELECT age.age_id, age.tip_id, age.age_documento, usu.id ,usu.name, usu.email
        FROM agentes AS age
        INNER JOIN users AS usu ON usu.id = age.user_id
        WHERE age.age_estado = 1
        AND age.age_id = ".$age_id;

        $agente = DB::select($sql_agente_data);

        $pdf = PDF::loadView('reportes.rep_agente_pdf', compact('data_report', 'agente'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream($agente[0]->name.'-'.$agente[0]->age_documento.'-reporte.pdf');


    }

}
