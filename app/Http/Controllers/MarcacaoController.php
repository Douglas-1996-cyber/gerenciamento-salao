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
        $marcacao = $this->marcacao->create($request->all());
        
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
    if(strtotime($marcacao->dt_marcacao) < strtotime(today())){
            return 'teste';
        }
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Marcacao $marcacao)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marcacao  $marcacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marcacao $marcacao)
    {
        dd(date('Y'));
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
