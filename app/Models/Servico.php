<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','valor_total','ref_mes','ref_ano','qtd','fechado','tipo_corte','valor_corte','desconto_total'];

    public function rules(){
        return [
           'ref_mes' => 'required',
           'ref_ano' => 'required',
           'qtd' => 'required|numeric'
       ];
       }
   
       public function feedback(){
           return [
               'required' => 'O campo :attribute é obrigatorio',
               'valor_total.numeric' => 'O valor deve ser numerico',
               'qtd.numeric' => 'O valor deve ser numerico'
           ];
       }
}
