<?php

namespace App\Http\Controllers;

use App\Models\Marcacao;
use Illuminate\Http\Request;

class MarcacaoController extends Controller
{

    public function __construct(Marcacao $marcacao){
        $this->marcacao = $marcacao;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $this->autoDelete($user_id);
        $marcacoes = $this->marcacao->where('user_id',$user_id)->get();
        return view('marcacao.index',['marcacoes'=>$marcacoes]);
     }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $this->marcacao->user_id = $user_id;
        $this->marcacao->nome = $request->nome;
        $this->marcacao->dt_marcacao = $request->dt_marcacao;
        $this->marcacao->hora = $request->hora;

        $marcacao = $this->marcacao->save();
        
        $marcacoes = $this->marcacao->where('user_id',$user_id)->get();
        return redirect()->route('marcacao.index',['marcacoes'=>$marcacoes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function show(Marcacao $marcacao)
    {

      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Marcacao $marcacao)
    {
        return view('marcacao.edit',['marcacao'=>$marcacao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marcacao $marcacao)
    {
        $user_id = auth()->user()->id;
        $marcacoes = $marcacao->where('user_id',$user_id)->get();
        if($marcacao == null){
            return redirect()->route('marcacao.index',['marcacoes'=>$marcacoes]);
           }
        $marcacao->fill($request->all());
        $marcacao->save();
     
        return redirect()->route('marcacao.index',['marcacoes'=>$marcacoes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marcacao $marcacao)
    {
        
    }
    public function autoDelete($user_id){

    $marcacoes = $this->marcacao->where('user_id',$user_id)->get();
     foreach($marcacoes as $m){
        if(strtotime($m->dt_marcacao) < strtotime(today())){
            $m->delete();
        }
     }
    }
}
