<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Mail;

use App\Models\tipos_proceso;
use App\Models\departamento;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $tipos_procesos = tipos_proceso::where('tpp_estado', '=', '1')->get();
        $departamentos = departamento::where('dep_estado', '=', '1')->get();

        return view('reportes.index', compact('tipos_procesos', 'departamentos'));
    }

    function reporte_descarga(request $request){

        $tpp_id = $request->tipo_proceso;
        $dep_id = $request->departamento;
        $rep_formato = $request->rep_formato;
        $fecha_ini = $request->rep_fecha_ini;
        $fecha_fin = $request->rep_fecha_fin;

        if($rep_formato == "excel"){
            dd('excel');
        }else if ($rep_formato == "pdf") {
            $gestiones = $this->busca_gestion($tpp_id, $fecha_ini, $fecha_fin);
            $cantidad = $this->contar_gestiones($tpp_id, $fecha_ini, $fecha_fin);

            $pdf = PDF::loadView('reportes.pdf', compact('gestiones', 'cantidad'));
            $nombre = $fecha_ini."-".$fecha_fin."-";
            return $pdf->stream($nombre.'reporte.pdf');
        }else{
            dd('error '.$rep_formato);
        }


    }

    function busca_gestion($tpp_id, $fecha_ini, $fecha_fin){
        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 1
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 2
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 3
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 4
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 5
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 6
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;
            case 7:
                /* REPROGRAMACION */

                $sql = "SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
                FROM tipos_gestiones AS tge
                LEFT JOIN (
                    SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
                    FROM gestiones AS ges
                    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                    INNER JOIN cargues AS car ON car.car_id = pro.car_id
                    WHERE ges.ges_estado = 1
                    AND car.tpp_id = 7
                    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                    GROUP BY tge.tge_nombre
                ) T1 ON T1.tge_nombre = tge.tge_nombre";

                break;

            default:

                $sql = "";

                break;
        }

        return $gestiones = DB::select($sql);

    }

    function contar_gestiones($tpp_id, $fecha_ini, $fecha_fin){
        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 1
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 2
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 3
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 5
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 5
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 6
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 7:
                /* REPROGRAMACION */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 7
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;

            default:

                $sql = "";

                break;
        }

        $cantidad = DB::select($sql);

        return $a = $cantidad[0]->cantidad;

    }

    function total_gestiones($tpp_id, $fecha_ini, $fecha_fin){
        switch ($tpp_id) {
            case 1:
                /* INASISTIDOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 1
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 2:
                /* SEGUIMIENTOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 2
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 3:
                /* RECORDATORIOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 3
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 4:
                /* HOSPITALIZADOS */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 5
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 5:
                /* BRIGADA */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 5
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 6:
                /* REPROGRAMACION */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 6
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;
            case 7:
                /* REPROGRAMACION */

                $sql = "SELECT count(ges.tge_id) AS cantidad
                FROM gestiones AS ges
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
                INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                WHERE ges.ges_estado = 1
                AND car.tpp_id = 7
                AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'";

                break;

            default:

                $sql = "";

                break;
        }

        $cantidad = DB::select($sql);

        return $a = $cantidad[0]->cantidad;

    }

}


/* SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
FROM tipos_gestiones AS tge
LEFT JOIN (
	SELECT tge.tge_nombre AS tge_nombre, count(ges.tge_id) AS cantidad
    FROM gestiones AS ges
    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
    INNER JOIN cargues AS car ON car.car_id = pro.car_id
    WHERE ges.ges_estado = 1
    AND car.tpp_id = 7
    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
    GROUP BY tge.tge_nombre
) T1 ON T1.tge_nombre = tge.tge_nombre */


/* SELECT count(ges.tge_id) AS cantidad
    FROM gestiones AS ges
    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = ges.tge_id
    INNER JOIN procesos AS pro ON pro.pro_id = ges.pro_id
    INNER JOIN cargues AS car ON car.car_id = pro.car_id
    WHERE ges.ges_estado = 1
    AND car.tpp_id = 7
    AND ges.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."' */
