<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brigada extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id','bri_fecha','bri_convenio','bri_punto_acopio','bri_especialidad',
    'bri_fecha_ultimo_control','bri_dias_transcurrido','bri_fecha_cita'];
}
