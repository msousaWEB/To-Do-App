@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Adicionar Tarefa') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('task.store')}}">
                        @csrf
                        <div class="form-group">
                          <label class="form-label">Tarefa</label>
                          <input name="task" type="text" class="form-control" placeholder="Descreva a sua tarefa">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Data para conclusão</label>
                          <input name="date_limit" type="date" class="form-control">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Cadastrar tarefa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
