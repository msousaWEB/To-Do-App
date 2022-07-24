@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$task->task}}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="form-group">
                            <label class="form-label">Data para conclusão</label>
                            <input type="date" value="{{$task->date_limit}}" class="form-control">
                        </div>
                    </fieldset>
                    <br>
                    <a href="{{url()->previous()}}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
