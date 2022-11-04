<?php

namespace App\Imports;

use App\Models\municipio;
use App\Models\departamento;
use App\Models\tipos_identificacione;
use App\Models\cargue;
use App\Models\proceso;
use App\Models\paciente;
use App\Models\actas_cargue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class CaptacionImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{

    protected $acc_codigo;
    protected $file_name;
    protected $r_leidos = 0;
    protected $r_duplicados = 0;
    protected $r_cargados = 0;
    protected $car_id = 0;

    public function __construct(string $acc_codigo, string $file_name)
    {
        $this->acc_codigo = $acc_codigo;
        $this->file_name = $file_name;
    }

    public function model(array $row)
    {
        $this->r_leidos = $this->r_leidos+1;

        $ti = tipos_identificacione::where('tip_alias', '=', $row['documento'])->get();
        $departamento = departamento::where('dep_nombre', '=', $row['departamento'])->get();
        $municipio = municipio::where('mun_nombre', '=', $row['municipio'])->get();

        $validador_pac = paciente::where('pac_identificacion', $row['numero_de_documento'])->count();

        if($validador_pac == 0){
            $nombre_completo = $row['primer_nombre'].' '.$row['segundo_nombre'].' '.$row['primer_apellido'].' '.$row['segundo_apellido'];
            /* dd(intval($municipio[0]->mun_id)); */
            $paciente = paciente::create([
                'tip_id' => $ti[0]->tip_id,
                'pac_identificacion' => $row['numero_de_documento'],
                'pac_primer_nombre' => $row['primer_nombre'],
                'pac_segundo_nombre' => $row['segundo_nombre'],
                'pac_primer_apellido' => $row['primer_apellido'],
                'pac_segundo_apellido' => $row['segundo_apellido'],
                'pac_nombre_completo' => $nombre_completo,
                'pac_telefono' => $row['telefono'],
                'pac_fecha_nacimiento' => $row['fecha_nacimiento'],
                'dep_id' => $departamento[0]->dep_id,
                'mun_id' => $municipio[0]->mun_id,
                'pac_direccion' => $row['direccion'],
                'pac_sexo' => $row['sexo'],
                'pac_regimen_afiliacion_SGSS' => $row['regimen_afiliacion_sgss']
            ]);

            $pac_id = $paciente->id;
        }else{
            $paciente = paciente::where('pac_identificacion', $row['numero_de_documento'])->get();

            $pac_id = $paciente[0]->pac_id;
        }


        $fecha = date('d-m-Y H:i:s');


        if($this->car_id == 0){
            $cargue = cargue::create([
                'car_fecha_cargue' => $fecha,
                'car_mes' => $row['mes'],
                'car_fecha_reporte' => $row['fecha_reporte'],
                'tpp_id' => '7',
            ]);

            $this->car_id = $cargue->id;
        }

        $validador_pro = proceso::where('car_id', $this->car_id)->where('pac_id', $pac_id)->count();

        if($validador_pro == 0){
            $proceso = proceso::create([
                'car_id' => $this->car_id,
                'pac_id' => $pac_id,
                'pro_prioridad' => $row['prioridad']
            ]);

            $this->r_cargados = $this->r_cargados+1;
        }else{
            $this->r_duplicados = $this->r_duplicados+1;
        }

        $validador_acc = actas_cargue::where('Acc_codigo', $this->acc_codigo)->count();

        if($validador_acc == 0){
            actas_cargue::create([
                'Acc_codigo' => $this->acc_codigo,
                'Acc_nombre' => $this->file_name,
                'Acc_leidos' => $this->r_leidos,
                'Acc_duplicados' => $this->r_duplicados,
                'Acc_cargados' => $this->r_cargados
            ]);
        }else{
            actas_cargue::where('Acc_codigo', $this->acc_codigo)->update(['Acc_leidos' => $this->r_leidos]);
            actas_cargue::where('Acc_codigo', $this->acc_codigo)->update(['Acc_duplicados' => $this->r_duplicados]);
            actas_cargue::where('Acc_codigo', $this->acc_codigo)->update(['Acc_cargados' => $this->r_cargados]);
        }

    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }

    public function rules(): array
    {
        return [
            'numero_de_documento' => 'required',
            '*.numero_de_documento' => 'required',

            'primer_nombre' => 'required',
            '*.primer_nombre' => 'required',

            'primer_apellido' => 'required',
            '*.primer_apellido' => 'required',

            'telefono' => 'required',
            '*.telefono' => 'required',

            'fecha_nacimiento' => 'required|string',
            '*.fecha_nacimiento' => 'required|string',

            'documento' => 'required|exists:tipos_identificaciones,tip_alias',
            '*.documento' => 'required|exists:tipos_identificaciones,tip_alias',

            'departamento' => 'required|exists:departamentos,dep_nombre',
            '*.departamento' => 'required|exists:departamentos,dep_nombre',

            'municipio' => 'required|exists:municipios,mun_nombre',
            '*.municipio' => 'required|exists:municipios,mun_nombre',
        ];
    }

}
