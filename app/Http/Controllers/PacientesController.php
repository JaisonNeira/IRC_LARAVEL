<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\paciente;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\tipos_identificacione;
use App\Models\cargue;
use App\Models\proceso;

class PacientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $pacientes = paciente::where('pac_estado', '=', '1')->get();

        $departamentos = departamento::all();

        $tipos_identificacion = tipos_identificacione::where('tip_estado', '=', '1')->get();

        return view('consultar-pacientes.index', compact('pacientes', 'departamentos', 'tipos_identificacion'));

    }

    public function dep_mun(request $request){

        $sql = "SELECT * FROM `municipios` WHERE `dep_id` = ".$request->dep_id;

        $municipios = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "municipios" => $municipios
            )
        );

    }

    public function create(request $request){

        $this->validate($request, [
            'tip_id' => 'required',
            'pac_identificacion' => 'required|unique:pacientes,pac_identificacion',
            'pac_primer_nombre' => 'required',
            'pac_segundo_nombre' => '',
            'pac_primer_apellido' => 'required',
            'pac_segundo_apellido' => '',
            'pac_telefono' => 'required',
            'pac_fecha_nacimiento' => '',
            'dep_id' => 'required',
            'mun_id' => 'required',
            'pac_direccion' => '',
            'pac_sexo' => 'required',
            'pac_regimen_afiliacion_SGSS' => ''
        ]);

        $nombre_completo = $request->pac_primer_nombre.' '.$request->pac_segundo_nombre.' '.$request->pac_primer_apellido.' '.$request->pac_segundo_apellido;

            $paciente = paciente::create([
                'tip_id' => $request->tip_id,
                'pac_identificacion' => $request->pac_identificacion,
                'pac_primer_nombre' => $request->pac_primer_nombre,
                'pac_segundo_nombre' => $request->pac_segundo_nombre,
                'pac_primer_apellido' => $request->pac_primer_apellido,
                'pac_segundo_apellido' => $request->pac_segundo_apellido,
                'pac_nombre_completo' => $nombre_completo,
                'pac_telefono' => $request->pac_telefono,
                'pac_fecha_nacimiento' => $request->pac_fecha_nacimiento,
                'dep_id' => $request->dep_id,
                'mun_id' => $request->mun_id,
                'pac_direccion' => $request->pac_direccion,
                'pac_sexo' => $request->pac_sexo,
                'pac_regimen_afiliacion_SGSS' => $request->pac_regimen_afiliacion_SGSS,
            ]);

            $pac_id = $paciente->id;

            $n_mes = date("m");

            $meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];

            $mes = $meses[$n_mes - 1];

            $fecha = date('d-m-Y H:i:s');
            $fecha2 = date('Y-m-d');

            $validador = cargue::where('car_estado', '=', '1')->where('tpp_id', '=', '7')->where('car_mes', '=', $mes)->where('sys', '=', '1')->count();

            if($validador == 0){
                $cargue = cargue::create([
                    'car_fecha_cargue' => $fecha,
                    'car_mes' => $mes,
                    'car_fecha_reporte' => $fecha2,
                    'tpp_id' => '7',
                    'car_activo' => 'SI',
                    'sys' => 1
                ]);

                $car_id = $cargue->id;
            }else{
                $cargue = cargue::where('car_estado', '=', '1')->where('tpp_id', '=', '7')->where('car_mes', '=', $mes)->where('sys', '=', '1')->get();
                $car_id = $cargue[0]->car_id;
            }

            $proceso = proceso::create([
                'car_id' => $car_id,
                'pac_id' => $pac_id,
                'pro_prioridad' => $request->pro_prioridad
            ]);


            return back()->with('mSucces', 'Paciente registrado correctamente');

    }

}
