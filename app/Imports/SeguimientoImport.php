<?php

namespace App\Imports;

use App\Models\seguimientos_demandas_inducida;
use Maatwebsite\Excel\Concerns\ToModel;

class SeguimientoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new seguimientos_demandas_inducida([
            //
        ]);
    }
}
