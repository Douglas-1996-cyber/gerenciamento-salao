@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
           <div class="card">
                <div class="card-header"> Lista de Agendados </div>    
                <div class="card-body">
                 <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                     <table class="table table-hover table-responsive-md">
                        <thead>
                            <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th></th>
                            </tr>
                        </thead>
                        @foreach ($marcacoes as $marcacao )
                        <tbody>

                            <tr>
                            <th scope="row">{{$marcacao->nome}}</th>
                            <td>{{date('d/m/Y', strtotime($marcacao->dt_marcacao))}}</td>
                            <td>{{ $marcacao->hora}}</td>
                            <td><a class="btn btn-outline-primary" href="{{route('marcacao.edit',$marcacao->id)}}">Alterar</a></td>
                            </tr>
                        </tbody>
                        @endforeach
                        </table>
                </div>
                  
            </div>
        </div>
    </div>
</div>
@endsection
