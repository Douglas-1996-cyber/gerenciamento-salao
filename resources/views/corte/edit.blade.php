@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alterar Corte</div>
                <div class="card-body">
               <form method="post" action="{{route('corte.update',['corte'=>$corte->id])}}">
                      @csrf
                      @method('PUT')
                 
                            <div class="form-group">
                                <label for="tipo">Tipo de corte</label>
                                <input name="tipo" type="text" class="form-control" id="tipo" value="{{$corte->tipo}}" required>
                                <p class="vermelho">{{ $errors->has('tipo') ? $errors->first('tipo') : ''}}</p>
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor do corte</label>
                                <input name="valor" type="number" class="form-control" id="valor" step="0.01" min="0" value="{{$corte->valor}}" required>
                                <p class="vermelho">{{ $errors->has('valor') ? $errors->first('valor') : ''}}</p>
                            </div>
                          
                              <button type="submit" class="btn btn-primary">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


