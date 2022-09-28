@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
           <div class="card">
                <div class="card-header">Lista de serviços</div>
        
                    <div class="card-body">
                     <table class="table table-hover">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
