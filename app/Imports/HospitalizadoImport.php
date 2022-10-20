<?php

namespace App\Imports;

use App\Models\hospitalizado;
use Maatwebsite\Excel\Concerns\ToModel;

class HospitalizadoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new hospitalizado([
            //
        ]);
    }
}
