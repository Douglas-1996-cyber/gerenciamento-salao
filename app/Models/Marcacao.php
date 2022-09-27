<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcacao extends Model
{
    use HasFactory;
   protected $table = 'marcacoes'; 
   protected $fillable = ['user_id','nome','hora','dt_marcacao'];
}
