<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recordatorio extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'rec_fecha_cita', 'rec_convenio', 'rec_especialidad', 'rec_profesional',
     'rec_modalidad', 'rec_pym', 'rec_tipo_de_recordatorio'];
}
