<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actas_cargue extends Model
{
    use HasFactory;
    protected $fillable = ['Acc_codigo','Acc_nombre','Acc_fecha_recepcion','Acc_leidos', 'Acc_duplicados', 'Acc_cargados'];
}
