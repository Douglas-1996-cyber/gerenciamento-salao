@extends('layouts.inicial')

@section('content')
<div class="blocoCadastro">
<div class="conteudo">
    <div class="titulo">Cadastro</div>
    <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="formulario">
                <label for="name" id="labelNome">Nome:</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="email" id="labelEmailCadastro">Email:</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="password" id="labelSenhaCadastro">Senha:</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="password-confirm" id="labelConfirme">Confirme a senha:</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <button type="submit" class="botao">
                        Cadastrar
                    </button>
            </div>
    </form>
            <div class="mais">
                Já possue cadastro?Realize o seu <a href="{{ route('login') }}">Login</a>
            </div>
 </div>
@endsection

