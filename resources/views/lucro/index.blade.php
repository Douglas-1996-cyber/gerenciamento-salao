@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
           <div class="card">
                <div class="card-header">
                Lucros
                </div>       
                <div class="card-body">
                     <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                            <th scope="col">Mês/Ano</th>
                            <th scope="col">Total</th>
                            <th scope="col">Desconto</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($lucros as $lucro )
                        <form id="form_fechar{{$lucro->id}}" method="post" action=" {{ route('lucro.fechar', ['lucro' => $lucro->id])}}">
                                    @method('PATCH')
                                    @csrf       
                        </form>
                        <tbody>
                            <tr>
                            <th scope="row">{{$lucro->ref_mes}}/{{$lucro->ref_ano}}</th>
                            <td>R${{$lucro->total}}</td>
                            <td>R${{$lucro->desconto_total}}</td>
                            <td><button class="btn btn-outline-danger"  data-toggle="modal" data-target="#fecharModalID{{$lucro->id}}"  {{$lucro->fechado == 1 ? 'disabled' : '' }}>Fechar</button>
                                 <a class="btn btn-outline-success" href="{{route('lucro.show', ['lucro'=>$lucro->id])}}">Detalhes</a></td>
                            </tr>
                        </tbody>
                        
                            <div class="modal fade" id="fecharModalID{{$lucro->id}}" tabindex="-1" role="dialog" aria-labelledby="fecharModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excluirModalLabel">Deseja Fechar?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                     Todos os serviços sobre o periodo "{{$lucro->ref_mes}}/{{$lucro->ref_ano}}" será fechado, tem certeza da operação?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                        <button type="button"  onclick="document.getElementById('form_fechar{{ $lucro->id}}').submit()" class="btn btn-danger">Continuar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

                        @endforeach
                        </table>
                </div>
         
         
                   
            </div>
        </div>
    </div>
</div>
@endsection
