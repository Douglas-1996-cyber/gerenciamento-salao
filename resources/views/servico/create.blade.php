@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Adicionar Serviço</div>
                <div class="card-body">
                 <form method="post" action="{{route('servico.store')}}">
                        @csrf
                      <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}">
                      <input type="hidden" class="form-control" name="ref_ano" value="{{date('Y')}}">
                      
                           @if($msg != '') 
                            <div class="col-md-10 alert alert-danger" role="alert">
                                {{$msg}}
                           </div>
                           @endif
                          <div class="form-row align-items-center">
                                <div class="col-md-10"> 
                                  <label for="tipo">Tipo de corte</label>
                                   <select name="corte_id" class="custom-select mr-sm-2" id="corte_id" required>
                                    <option value = "0"  selected>Selecione</option>
                                      @foreach ($cortes as $corte )
                                    <option value="{{$corte->id}}">{{$corte->tipo}}</option>
                                       @endforeach
                                </select>
                                <p class="vermelho">{{ $errors->has('corte_id') ? $errors->first('corte_id') : ''}}</p>
                                </div>
                            </div>
                           <label for="valor">Selecione o mês</label>
                          <div class="form-row align-items-center">
                            <div class="col-md-10"> 
                                   <select name="ref_mes" class="custom-select mr-sm-2" id="ref_mes" required>
                                    <option value = "0" selected>Selecione</option>
                                      @foreach ($meses as $mes=>$key )
                                    <option value="{{$key}}">{{$mes}}</option>
                                       @endforeach
                                </select>
                            
                            </div> 
                           </div>

                            <div class="form-row align-items-center">
                                <div class="col-md-10"> 
                                <label for="valor">Quantidade</label>
                                 <input name="qtd" type="number" class="form-control mb-4 mr-sm-2"  placeholder="Informe a quantidade" required>
                            </div>     
                            </div>
                              <button type="submit" class="btn btn-primary">Cadastrar</button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



   
