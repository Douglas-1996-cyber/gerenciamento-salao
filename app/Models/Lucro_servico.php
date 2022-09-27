<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lucro_servico extends Model
{
    use HasFactory;
    protected $table = 'lucro_servicos'; 
    protected $fillable = ['user_id','servico_id','lucro_id'];

    
}
