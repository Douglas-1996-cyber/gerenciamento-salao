@extends('layouts.inicial')

@section('content')
<div class="blocoLogin">
        <div class="titulo">Login</div>
          
            <form method="POST" action="{{ route('login') }}">
            <div class="formulario">
                @csrf
              
                    <label for="email" id="labelEmail">Email:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    

                    <label for="password" id="labelSenha">Senha:</label>
                
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                     <button type="submit" class="botao">Entrar</button>
           </div>
           </form>
        
            @error('email')
                            <span class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
             @error('password')
                            <span class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
            @enderror
        <div class="mais">
        <p>É novo por aqui? <a href="{{ route('register') }}">Cadastre-se</a></p>
        </div>

</div>
@endsection