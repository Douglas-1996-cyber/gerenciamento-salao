@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Cadastrar</div>
                 <div class="card-body">
                   <form method="post" action="{{route('marcacao.store')}}">
                        @csrf
                
                                <div class="form-group">
                                    <label for="nome">Informe o nome</label>
                                    <input name="nome" type="text" class="form-control" id="nome"  required>
                                </div>
                                 
                                <div class="form-group">
                                    <label for="valor">Informe a data</label>
                                    <input name="dt_marcacao" type="date" class="form-control" id="dt_marcacao" required>
                                
                                </div>
                                
                                <div class="form-group">
                                    <label for="valor">Informe a hora</label>
                                    <input name="hora" type="time" class="form-control" id="hora" required>
                                
                                </div>
                              
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection


