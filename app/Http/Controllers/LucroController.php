<?php

namespace App\Http\Controllers;

use App\Models\Lucro;
use App\Models\Lucro_servico;
use App\Models\Servico;
use Illuminate\Http\Request;

class LucroController extends Controller
{

    public function __construct(Lucro $lucro){
        $this->lucro = $lucro;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $lucros = $this->lucro->where('user_id',$user_id)->get();
        
        return view('lucro.index',['lucros'=>$lucros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lucro  $lucro
     * @return \Illuminate\Http\Response
     */
    public function show(Lucro $lucro)
    {
       $servicoID = Lucro_servico::where('lucro_id', $lucro->id)->value('servico_id');
       $servicos = Servico::where('id',$servicoID)->get();
    
        return view ('lucro.show', ['lucro' => $lucro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lucro  $lucro
     * @return \Illuminate\Http\Response
     */
    public function edit(Lucro $lucro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lucro  $lucro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lucro $lucro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lucro  $lucro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lucro $lucro)
    {
        //
    }

    public function fechar(Lucro $lucro){
     $user_id = auth()->user()->id;
     $servicos = Servico::where('ref_mes',$lucro->ref_mes)->where('ref_ano',$lucro->ref_ano)->where('user_id',$user_id)->get();
     $cont = 0;
    foreach($servicos as $servico){
        $servico->fechado = 1;
        $servico->save();
     }
     $lucro->fechado = 1;
     $lucro->save();
     $lucros = $this->lucro->where('user_id',$user_id)->get();
     return redirect()->route('lucro.index',['lucros'=>$lucros]);
     
    }
}
