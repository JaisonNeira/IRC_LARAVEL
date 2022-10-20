<?php

namespace App\Imports;

use App\Models\brigada;
use Maatwebsite\Excel\Concerns\ToModel;

class BrigadaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new brigada([
            //
        ]);
    }
}
