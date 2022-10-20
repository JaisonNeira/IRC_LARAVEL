<?php

namespace App\Imports;

use App\Models\inasistido;
use Maatwebsite\Excel\Concerns\ToModel;

class InasistidoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new inasistido([
            //
        ]);
    }
}
