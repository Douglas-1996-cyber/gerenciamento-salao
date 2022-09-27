@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="card">
                <div class="card-header">Lista de cortes </div>
        
                <div class="card-body">
                     <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Valor</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($cortes as $corte )
                        <tbody>
                        
                         <form id="form_{{ $corte->id}}" method="post" action=" {{ route('corte.destroy', ['corte' => $corte->id])}}">
                                    @method('DELETE')
                                    @csrf
                        </form>
                            <tr>
                            <td>{{$corte->tipo}}</td>
                            <td>R${{$corte->valor}}</td>
                            <td>
                            <a class="btn btn-outline-primary" href="{{route('corte.edit',$corte->id)}}">Alterar</a>
                            <a class="btn btn-outline-danger"  data-toggle="modal" data-target="#excluirModalID{{$corte->id}}">Excluir</a>
                            </td>
                            </tr>
                            <div class="modal fade" id="excluirModalID{{$corte->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="excluirModalLabel">Deseja Excluir?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      O tipo de corte "{{$corte->tipo}}" será excluido, tem certeza da operação?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="button"  onclick="document.getElementById('form_{{ $corte->id}}').submit()" class="btn btn-danger">Excluir</button>
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
@endsection
