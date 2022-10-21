<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargue extends Model
{
    use HasFactory;
    protected $fillable = ['car_fecha_cargue','car_mes','car_fecha_reporte','tpp_id'];
}
