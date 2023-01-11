@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
           <div class="card">
                <div class="card-header">Lista de serviços</div>
            <form id="form_pesquisar" method="post" action=" {{ route('servico.pesquisar')}}">   
                             @csrf
               <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                          <div class="float-end input-group mb-2 float-start">
                                <select name='mes' class="form-select">
                                        <option selected>Mês</option>
                                            @foreach($mes as $key=>$valor)
                                                <option value="{{ $valor}}">{{$key}}</option>
                                            @endforeach
                                </select>
                                <input type="number" name="ano" class="form-control" placeholder="Ano" >
                              <button class="btn btn-outline-secondary " type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            </button>    
                            </div>  
                         </div>  
                               
                    </div>
                </div>
                 </form>
                        <div class="card-body">
                     <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                            <th scope="col">Tipo de corte</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Total</th>
                            <th scope="col">Mês/Ano</th>
                            <th></th>
                            </tr>
                        </thead>
                         @foreach ($servicos as $servico )
                        <tbody>
                       
                         <form id="form_delete{{ $servico->id}}" method="post" action=" {{ route('servico.destroy', ['servico' => $servico->id])}}">
                                    @method('DELETE')
                                    @csrf
                        </form>
                            <tr>
                            <th scope="row">{{$servico->tipo_corte}}</th>
                            <td>R${{$servico->valor_corte}}</td>
                            <td>{{$servico->qtd}}</td>
                            <td>R${{$servico->valor_total}}</td>
                            <td>{{$servico->ref_mes}}/{{$servico->ref_ano}}</td>
                            <td>
                            <button class="btn btn-outline-success"   data-toggle="modal" data-target="#addQtdModalID{{$servico->id}}" {{$servico->fechado == 1 ? 'disabled' : '' }}>Adicionar</button>
                            <button  class="btn btn-outline-danger"  data-toggle="modal" data-target="#excluirModalID{{$servico->id}}" {{$servico->fechado == 1 ? 'disabled' : '' }}>Excluir</button>
                            </td>
                            </tr>

                            <div class="modal fade" id="excluirModalID{{$servico->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excluirModalLabel">Deseja Excluir?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      O serviço sobre o corte "{{$servico->tipo_corte}}" será excluido, tem certeza da operação?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="button"  onclick="document.getElementById('form_delete{{ $servico->id}}').submit()" class="btn btn-danger">Excluir</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="modal fade" id="addQtdModalID{{$servico->id}}" tabindex="-1" role="dialog" aria-labelledby="addQtdModalLabel" aria-hidden="true">
                               
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addQtdModal">Informe os dados</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">
                                     <form method="post" id="form_adicionar{{ $servico->id}}" action="{{route('servico.adicionar',['servico'=>$servico->id])}}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}">
                                            <div class="form-group">
                                            <label >Informe a quantidade</label>
                                                <input type="number" class="form-control" name="qtd" min="0">
                                            </div>
                                            <div class="form-group">
                                                <label >Informe o valor de desconto se tiver</label>
                                                <input type="number" class="form-control" name="desconto" min="0">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="button"  onclick="document.getElementById('form_adicionar{{ $servico->id}}').submit()" class="btn btn-success">Adicionar</button>
                                    </div>
                                  </div>
                               </div>
                            </div>
                         
                        </tbody>
                         @endforeach
                        </table>
                            <div class="col-6 vermelho">
                            {{$invalid}}
                        </div> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
