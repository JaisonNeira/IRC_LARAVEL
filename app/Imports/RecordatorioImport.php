<?php

namespace App\Imports;

use App\Models\recordatorio;
use Maatwebsite\Excel\Concerns\ToModel;

class RecordatorioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new recordatorio([
            //
        ]);
    }
}
