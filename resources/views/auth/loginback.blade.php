<html>
<head>
<title>Login</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
  .inicial{
  background-color: #1d68a7;
  position: relative;
  width: 100%;
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
  
}
.card{
  
  width: 70%;
  height: 50%;
  position: absolute;
  top: 10%;
  left: 20%;
  border-radius: 30px;
  background-color: #1d68a7;

}
.titulo{
  font-size: 30px;
  font-weight: bold;
  text-align: center;
}

.login {
 width: 50%;
 height: 100%;
 position: absolute;
 top: 0%;
 left: 0%;
 border-radius: 30px 0px 0px 30px;
 background-color: aliceblue;
 padding: 2px;
}
.cadastro{
  width: 50%;
  height: 100%;
  position: absolute;
  top: 0%;
  right: 0%;
  background-color: lightblue ;
  border-radius: 0px 30px 30px 0px;
  padding: 5px;
  font-family:Arial, Helvetica, sans-serif;
  font-size: 100%;


}
.btn-success{
  font-size: 1vw;
  position: absolute;
  left: 40%;
  border-radius: 30px;
}
.btn-primary{
  font-size: 1vw;
  position: absolute;
  left: 30%;
  border-radius: 30px;
}
.cadastro:hover{
  box-shadow: 0px 0px 10px black ;
}
.login:hover{
  box-shadow: 0px 0px 10px black ;
}

  </style>
</head>
<body>
<div class="inicial">
<div class="card">
<div class="login">
    <div class="titulo">Login</div>
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Senha:</label>
                <div class="col-md-6">
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Entrar
                    </button>
                  
                </div>
            </div>
        </form>
    </div>

    <div class="cadastro">
    <div class="titulo">Cadastrar</div>
    <div>
    <p>Realize o seu cadastro clicando no botão abaixo, e venha organizar as contas do seu salão de uma maneira intuitiva e rapida!</p>
    <button class="btn btn-success">Cadastrar</button>
    </div>
    </div>
    </div>
</div>
</body>