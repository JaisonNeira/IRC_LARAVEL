<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inasistido extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'ina_fecha_cita', 'ina_convenio_nombre', 'ina_medico_nombre', 'ina_medico_especialidad', 'ina_rotulo',
    'ina_pym', 'ina_modalidad', 'ina_estado_consulta', 'ina_motivo_inasistencia'];
}
