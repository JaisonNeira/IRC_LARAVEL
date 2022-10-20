<?php

namespace App\Imports;

use App\Models\reprogramacion;
use Maatwebsite\Excel\Concerns\ToModel;

class ReprogramacionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new reprogramacion([
            //
        ]);
    }
}
