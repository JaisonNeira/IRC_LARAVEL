<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hospitalizado extends Model
{
    use HasFactory;
    protected $fillable = ['pro_id', 'hos_diagnostico', 'hos_fecha_ingreso', 'hos_fecha_egreso', 'hos_programa', 'hos_pertenece_irc'];
}
