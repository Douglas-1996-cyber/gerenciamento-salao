@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bem vindo</div>

                <div class="card-body">
                   Seja bem vindo {{ Auth::user()->name }}. Quaisquer duvidas relaciondas ao sistema basta entrar entrar em contato
                   através do <a href=" https://wa.me/5585986859651">whatsapp</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
