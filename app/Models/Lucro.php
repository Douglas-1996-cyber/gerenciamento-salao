<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lucro extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','total','ref_mes','ref_ano','desconto_total','fechado'];

    public function servicos(){
        //return $this->belongsToMany('App\Models\Produto', 'pedido_produtos');
        return $this->belongsToMany('App\Models\Servico', 'lucro_servicos', 'lucro_id', 'servico_id')->withPivot('id','created_at');
    }
}
