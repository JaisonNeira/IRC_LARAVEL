<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class ReporteExport implements FromArray
{
    protected $gestiones;
    protected $meses_cargados;
    protected $tipos_gestiones;
    protected $tipos_procesos;
    protected $departamentos;

    public function __construct($gestiones, $meses_cargados, $tipos_gestiones, $tipos_procesos, $departamentos)
    {
        $this->gestiones = $gestiones;
        $this->meses_cargados = $meses_cargados;
        $this->tipos_gestiones = $tipos_gestiones;
        $this->tipos_procesos = $tipos_procesos;
        $this->departamentos = $departamentos;
    }

    public function array(): array
    {
        $meses_cargados = $this->meses_cargados;
        $tipos_gestiones = $this->tipos_gestiones;
        $gestiones = $this->gestiones;

        $matriz[0][0] = "Reporte de ".$this->tipos_procesos." del departamento de ".$this->departamentos;
        $a = 0;
        for ($i=1; $i < count($meses_cargados)+1; $i++) {
            $matriz[0][$i] = $meses_cargados[$a]->car_mes;
            $a += 1;
        }

        $b = 0;
        for ($i=1; $i < count($tipos_gestiones)+1; $i++) {
            $matriz[$i][0] = $tipos_gestiones[$b]->tge_nombre;
            $b += 1;
        }

        /* colocamos los 0 */
        $p1 = 1;
        for ($l=0; $l < count($tipos_gestiones); $l++) {

            $p2 = 1;
            for ($b=0; $b < count($meses_cargados); $b++) {
                $matriz[$p1][$p2] = "0";
                $p2 += 1;
            }
            $p1 += 1;
        }

        /* colocamos los contadores */
        for ($c=0; $c < count($gestiones); $c++) {
            $col = 0;
            $fil = 0;

            $a2 = 1;
            for ($x=0; $x < count($tipos_gestiones); $x++) {

                if($matriz[$a2][0] == $gestiones[$c]->tge_nombre){
                    $fil = $a2;
                }
                $a2 += 1;
            }

            $a1 = 1;
            for ($i=0; $i < count($meses_cargados); $i++) {
                /* $i es la columna */
                if($matriz[0][$a1] == $gestiones[$c]->car_mes){
                    $col = $a1;
                }
                $a1 += 1;
            }

            $matriz[$fil][$col] = $gestiones[$c]->cantidad;

        }

        return $matriz;
    }
}
