<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seguimientos_demandas_inducida extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'sdi_especialidad', 'sdi_fecha_ultimo_control', 'sdi_fecha_cita'];
}
