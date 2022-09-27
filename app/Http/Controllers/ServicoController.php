<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Corte;
use App\Models\Lucro;
use App\Models\Lucro_servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function __construct(Servico $servico){
        $this->servico = $servico;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $user_id = auth()->user()->id;
        $servicos = $this->servico->where('user_id',$user_id)->get();
        return view('servico.index',['servicos'=>$servicos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $cortes = Corte::where('user_id',$user_id)->get();
        return view('servico.create',['cortes'=>$cortes,'meses'=>$this->mes(),'msg'=>'']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cortes = Corte::all();
  
        if($request->corte_id == 0){
        return view('servico.create',['cortes'=>$cortes,'meses'=>$this->mes(),'msg'=>'Selecione o tipo de corte']);
        }else 
        if($request->ref_mes == 0){
              return view('servico.create',['cortes'=>$cortes,'meses'=>$this->mes(),'msg'=>'Selecione o mês']);
        }
     
        $tipo_corte = Corte::where('id',$request->corte_id)->value('tipo');
        $valor_corte = Corte::where('id',$request->corte_id)->value('valor');
   
        $request->validate($this->servico->rules(),$this->servico->feedback());
        $this->servico->tipo_corte = $tipo_corte; 
        $this->servico->valor_corte = $valor_corte; 
        $total = $valor_corte * $request->qtd;
        $this->servico->valor_total = $total;
        $this->servico->user_id = auth()->user()->id;
        $this->servico->ref_mes = $request->ref_mes;
        $this->servico->ref_ano = $request->ref_ano;
        $this->servico->qtd = $request->qtd;
        $this->servico->fechado = 0;
        $query = $this->servico->where('ref_mes',$request->ref_mes)->where('ref_ano',$request->ref_ano)->where('tipo_corte',$tipo_corte)->get();
        
        if(sizeof($query) != 0){
            $cortes = Corte::all();
            return view('servico.create',['cortes'=>$cortes,'meses'=>$this->mes(),'msg'=>'Dados duplicados']);
        }
       $this->servico->save();
        $user_id = auth()->user()->id;
        $servicos = $this->servico->where('user_id',$user_id)->get();
        $totalLucro = Lucro::where('ref_mes',$this->servico->ref_mes)->where('ref_ano',$this->servico->ref_ano)->where('user_id',$user_id)->value('total');
       $total += $totalLucro;
  
        $lucroServico = Lucro_servico::create([
            'user_id' => $user_id,
            'servico_id' => $this->servico->id,
            'lucro_id' =>  $this->cadastrarLucro($this->servico->id, $user_id,$total,0)
         ]);
        return redirect()->route('servico.index',['servicos'=>$servicos]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function show(Servico $servico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function edit(Servico $servico)
    {
        $cortes = Corte::all();
        return view('servico.edit',['servico' => $servico,'cortes'=>$cortes,'meses'=>$this->mes()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {
        $user_id = auth()->user()->id;
        if($servico->fechado == 1){
            return ['msg'=>'Servico fechado'];
        }
       
        $idLucro = Lucro::where('ref_mes',$servico->ref_mes)->where('ref_ano',$servico->ref_ano)->where('user_id',$user_id)->value('id');
        $lucroQuery = Lucro::find($idLucro);
        $idLucro_servico = Lucro_servico::where('servico_id',$servico->id)->where('lucro_id',$idLucro)->value('id');
        $lucro_servicos =  Lucro_servico::find($idLucro_servico);
        if(sizeof($servico->where('ref_mes',$servico->ref_mes)->where('ref_ano',$servico->ref_ano)->get()) == 1){
        if($lucroQuery == null){
             $servico->delete();
            $servico = $this->servico->where('user_id',$user_id)->get();
            return redirect()->route('servico.index',['servicos'=>$servico]);
        }else{
            $lucro_servicos->delete();
            $servico->delete();
            $lucroQuery->delete();
            $servico = $this->servico->where('user_id',$user_id)->get();
            return redirect()->route('servico.index',['servicos'=>$servico]);
           

        }

         }
         if($lucro_servicos != null){
            $lucro_servicos->delete();
         }
         
         $lucroQuery->total -= $servico->valor_total;
         $lucroQuery->desconto_total =$servico->desconto_total; 
         $lucroQuery->save(); 
         
        $servico->delete();
        
        $servico = $this->servico->where('user_id',$user_id)->get();
        return redirect()->route('servico.index',['servicos'=>$servico]);
    }

    public function mes(){
        $mes = [
            'Janeiro' => 1,
            'Fervereiro' => 2,
            'Março' => 3,
            'Abril' => 4,
            'Maio' => 5,
            'Junho' => 6,
            'Julho' => 7,
            'Agosto' => 8,
            'Setembro' => 9,
            'Outubro' => 10,
            'Novembro' => 11,
            'Dezembro' => 12
        ];
        return $mes;

    }

    public function adicionar(Request $request, Servico $servico){
        $servico->qtd = $servico->qtd + $request->qtd;
        $total = 0;
        $desconto = 0;
        if($request->desconto != null){
          $total = ($servico->valor_corte * $request->qtd) - $request->desconto;
         $servico->valor_total += $total;
         $desconto = $request->desconto;
         $servico->desconto_total = $servico->desconto_total + $request->desconto;
        }else{
            $total = $servico->valor_corte * $request->qtd;
            $servico->valor_total += $total;
            $desconto = 0;
        }

       $totalLucro = Lucro::where('ref_mes',$servico->ref_mes)->where('ref_ano',$servico->ref_ano)->where('user_id',$request->user_id)->value('total');
       
       $total = $totalLucro+$total;
       
        
      $servico->save();
      $this->cadastrarLucro($servico->id, $request->user_id,$total,$desconto);
      $servico = $this->servico->where('user_id',$request->user_id)->get();
      return redirect()->route('servico.index',['servicos'=>$servico]);
    }

    public function cadastrarLucro($idServico,$user_id,$total,$desconto){
        $servico = Servico::find($idServico);
        $lucroID = Lucro::where('ref_mes',$servico->ref_mes)->where('ref_ano',$servico->ref_ano)->where('user_id',$user_id)->value('id');
        $lucroQuery = Lucro::find($lucroID);
        if($lucroQuery != null){
            $lucroQuery->total = $total;
            $lucroQuery->desconto_total +=$desconto; 
            $lucroQuery->save(); 
            return $lucroQuery->id;
        }
        //dd($servico->valor_total);
       $lucro = Lucro::create([
          'user_id' => $user_id,
          'total' => $servico->valor_total,
          'ref_mes' => $servico->ref_mes,
          'ref_ano' => $servico->ref_ano,
          'desconto_total' => $servico->desconto_total
       ]);

       return $lucro->id;

    }

}
