<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HospitalizadosExport implements FromCollection, WithHeadings
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
            "Documento",
            "Numero_de_documento",
            "Primer_nombre",
            "Segundo_nombre",
            "Primer_apellido",
            "Segundo_apellido",
            "Telefono",
            "Fecha_nacimiento",
            "Departamento",
            "Municipio",
            "Direccion",
            "Sexo",
            "Regimen_afiliacion_SGSS",
            "Fecha_reporte",
            "Mes",
            "Prioridad",
            "Diagnostico",
            "Fecha_ingreso",
            "Fecha_egreso",
            "Programa",
            "Pertenece_irc",
            "fecha de seguimiento 1",
            "resultado de la gestion 1",
            "fecha de seguimiento 2",
            "resultado de la gestion 2",
            "fecha de seguimiento 3",
            "resultado de la gestion 3",
            "motivo de hospitalizacion"
        ];
    }
}
