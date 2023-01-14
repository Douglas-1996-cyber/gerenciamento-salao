@extends('layouts.inicial')

@section('content')
<div class="blocoLogin">
    <div class="conteudo">
        <div class="titulo">Login</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="formulario">
                    <label for="email" id="labelEmail">Email:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                    <label for="password" id="labelSenha">Senha:</label>
                
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

            
                <button type="submit" class="botao">
                            Entrar
                </button>
        </div>
        </form>
        <div class="mais">
        <p>É novo por aqui? <a href="{{ route('register') }}">Cadastre-se</a></p>
        </div>
    </div>
@endsection