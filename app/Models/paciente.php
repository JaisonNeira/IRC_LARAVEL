<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    use HasFactory;
    protected $fillable = ['tip_id','pac_identificacion','pac_primer_nombre',
    'pac_segundo_nombre','pac_primer_apellido','pac_segundo_apellido',
    'pac_nombre_completo','pac_telefono','pac_fecha_nacimiento',
    'dep_id','mun_id','pac_direccion','pac_sexo','pac_regimen_afiliacion_SGSS'];
}
