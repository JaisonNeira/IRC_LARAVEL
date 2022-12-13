<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReprogramacionExport implements FromCollection, WithHeadings
{

    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'DPTO',
            'MUNICIPIO',
            'TIPO DE ID',
            'NUMERO DE ID',
            'REGIMEN',
            'PRIMER NOMBRE',
            'SEGUNDO NOMBRE',
            'PRIMER APELLIDO',
            'SEGUNDO APELLIDO',
            'FECHA DE NACIMIENTO',
            'DIRECCION',
            'TELEFONO',
            'CONVENIO',
            'FECHA CITA',
            'ESPECIALIDAD',
            'NUEVA CITA',
            'PROFESIONAL',
            'SEGUIMIENTO 1',
            'FECHA DE SEGUIMIENTO 1',
            'SEGUIMIENTO 2',
            'FECHA DE SEGUIMIENTO 2',
            'SEGUIMIENTO 3',
            'FECHA DE SEGUIMIENTO 3'
        ];
    }
}
