@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header col-md-15">
                Detalhes Lucros
                </div>       
                <div class="card-body">
                     <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Tipo de Corte</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Desconto</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                      @foreach ($lucro->servicos as $servico )
                        <tbody>
                            <tr>
                            <th scope="row">{{$servico->tipo_corte}}</th>
                            <td>R${{$servico->valor_corte}}</td>
                            <td>{{$servico->qtd}}</td>
                            <td>R${{$servico->valor_total}}</td>
                            <td>R${{$servico->desconto_total}}</td>
                            <td></td>
                            </tr>
                        @endforeach
                        </table>
                </div>
         
         
                   
            </div>
        </div>
    </div>
</div>
@endsection
