<?php

namespace App\Imports;

use App\Models\brigada;
use App\Models\tipos_identificacione;
use App\Models\cargue;
use App\Models\proceso;
use App\Models\paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
/* use Maatwebsite\Excel\Concerns\WithValidation; */
use Throwable;

class BrigadaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading/* , WithValidation */
{
    public function model(array $row)
    {
        $ti = tipos_identificacione::where('tip_alias', '=', $row['documento'])->get();

        $validador = paciente::where('pac_identificacion', $row['numero_de_documento'])->count();

        if($validador == 0){
            $nombre_completo = $row['primer_nombre'].' '.$row['segundo_nombre'].' '.$row['primer_apellido'].' '.$row['segundo_apellido'];
            /* dd(intval($ti[0]->tip_id)); */
            $paciente = paciente::create([
                'tip_id' => 1,
                'pac_identificacion' => $row['numero_de_documento'],
                'pac_primer_nombre' => $row['primer_nombre'],
                'pac_segundo_nombre' => $row['segundo_nombre'],
                'pac_primer_apellido' => $row['primer_apellido'],
                'pac_segundo_apellido' => $row['segundo_apellido'],
                'pac_nombre_completo' => $nombre_completo,
                'pac_telefono' => $row['telefono'],
                'pac_fecha_nacimiento' => $row['fecha_nacimiento'],
                'pac_departamento' => $row['departamento'],
                'pac_municipio' => $row['municipio'],
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

        $cargue = cargue::create([
            'car_fecha_cargue' => $fecha,
            'car_mes' => $row['mes'],
            'car_fecha_reporte' => $row['fecha_reporte'],
            'tpp_id' => '5',
        ]);


        $proceso = proceso::create([
            'car_id' => $cargue->id,
            'pac_id' => $pac_id,
            'pro_prioridad' => $row['prioridad']
        ]);

        $brigada = brigada::create([
            'pro_id' => $proceso->id,
            'bri_fecha' => $row['fecha_llegada'],
            'bri_convenio' => $row['convenio'],
            'bri_punto_acopio' => $row['punto_de_acopio'],
            'bri_especialidad' => $row['especialidad'],
            'bri_fecha_ultimo_control' => $row['fecha_ultimo_control'],
            'bri_dias_transcurrido' => $row['dias_transcurrido'],
            'bri_fecha_cita' => $row['fecha_cita']
        ]);


        

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
            'pac_identificacion' => 'required|unique:pacientes',

             // Above is alias for as it always validates in batches
             '*.pac_identificacion' => 'required|unique:pacientes'
        ];
    }
}
