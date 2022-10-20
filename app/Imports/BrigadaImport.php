<?php

namespace App\Imports;

use App\Models\brigada;
use App\Models\tipo_identificacione;
use App\Models\cargue;
use App\Models\paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class BrigadaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    public function model(array $row)
    {
        $ti = tipo_identificacione::where('tip_alias', $row['Documento'])->get();

        $nombre_completo = $row['Primer nombre'].' '.$row['Segundo nombre'].' '.$row['Primer apellido'].' '.$row['Segundo apellido'];

        $paciente = paciente::create([
            'pac_identificacion' => $row['Numero de documento'],
            'pac_primer_nombre' => $row['Primer nombre'],
            'pac_segundo_nombre' => $row['Segundo nombre'],
            'pac_primer_apellido' => $row['Primer apellido'],
            'pac_segundo_apellido' => $row['Segundo apellido'],
            'pac_nombre_completo' => $nombre_completo,
            'pac_telefono' => $row['Telefono'],
            'pac_fecha_nacimiento' => $row['Fecha nacimiento'],
            'pac_departamento' => $row['Departamento'],
            'pac_municipio' => $row['Municipio'],
            'pac_direccion' => $row['Direccion'],
            'pac_sexo' => $row['Sexo'],
            'pac_regimen_afiliacion_SGSS' => $row['Regimen afiliacion SGSS']
        ]);

        $fecha = date('d-m-Y H:i:s');

        $cargue = cargue::create([
            'car_fecha_cargue' => $fecha,
            'car_mes' => $row['Mes'],
            'car_fecha_reporte' => $row['Fecha reporte'],
            'tpp_id' => '5',
        ]);

        $proceso = 


    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }

    /* public function rules(): array
    {
        return [
            'email' => 'required|unique:users',

             // Above is alias for as it always validates in batches
             '*.email' => 'required|unique:users',

            'codigo' => 'unique:empleados,EMP_CODE',

             // Above is alias for as it always validates in batches
             '*.codigo' => 'unique:empleados,EMP_CODE',

            'cedula' => 'unique:empleados,EMP_CEDULA',

             // Above is alias for as it always validates in batches
             '*.cedula' => 'unique:empleados,EMP_CEDULA',
        ];
    } */
}
