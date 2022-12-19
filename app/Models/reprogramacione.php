<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reprogramacione extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'rep_convenio', 'rep_fecha_cita', 'rep_especialidad', 'rep_nueva_cita', 'rep_profesional'];
}
