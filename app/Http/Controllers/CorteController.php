<?php

namespace App\Http\Controllers;

use App\Models\Corte;
use Illuminate\Http\Request;

class CorteController extends Controller
{

    public function __construct(Corte $corte){
       $this->corte = $corte;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user_id = auth()->user()->id;
       $cortes = $this->corte->where('user_id',$user_id)->get();
       return view('corte.index',['cortes'=>$cortes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('corte.create',['msg'=>'']);
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
        $idCorte = $this->corte->where('tipo',$request->tipo)->where('user_id',$user_id)->value('id');
        $query = $this->corte->find($idCorte);
        if($query == null){
            $corte = $this->corte->create($request->all());
            $cortes = $this->corte->where('user_id',$user_id)->get();
           return redirect()->route('corte.index',['cortes'=>$cortes]);
        }else{
            return view('store.create',['msg'=>'Dados duplicados']);  
        }
      
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function show(Corte $corte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function edit(Corte $corte)
    {
        return view('corte.edit',['corte' => $corte]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corte $corte)
    {
        $corte->fill($request->all());
        $corte->save();
        $user_id = auth()->user()->id;
        $cortes = $corte->where('user_id',$user_id)->get();
        return redirect()->route('corte.index',['cortes'=>$cortes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corte $corte)
    {
       $corte->delete();
       $user_id = auth()->user()->id;
       $cortes = $this->corte->where('user_id',$user_id)->get();
       return redirect()->route('corte.index',['cortes'=>$cortes]);
    }
}
