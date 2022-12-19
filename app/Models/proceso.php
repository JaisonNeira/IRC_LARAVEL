<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proceso extends Model
{
    use HasFactory;
    protected $fillable = ['car_id','pac_id','pro_prioridad','pro_programa'];
}
