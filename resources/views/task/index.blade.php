@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6"><h2>Suas Tarefas</h2></div>
                        <div class="col-6">
                            <div style="float: right">    
                                <a href="{{route('task.export', ['extension' => 'xlsx'])}}" class="btn btn-secondary">XLSX</a>
                                <a href="{{route('task.export', ['extension' => 'csv'])}}" class="btn btn-secondary">CSV</a>
                                <a href="{{route('task.create')}}" class="btn btn-primary">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark" style="background-color:black; color:white">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data para conclusão</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $t)
                                <tr>
                                    <th scope="row">{{$t['id']}}</th>
                                    <td>{{$t['task']}}</td>
                                    <td>{{date('d/m/y', strtotime($t['date_limit']))}}</td>
                                    <td><a href="{{route('task.edit', $t['id'])}}" class="btn btn-primary">Editar</a></td>
                                    <td>
                                        <form id="form_{{$t['id']}}" method="POST" action="{{route('task.destroy', ['task' => $t['id']])}}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-danger" onclick="document.getElementById('form_{{$t['id']}}').submit()">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="{{$tasks->previousPageUrl()}}" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Anterior</span>
                            </a>
                          </li>

                          @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                            <li class="page-item {{$tasks->currentPage() == $i ? 'active' : ''}}">
                                <a class="page-link" href="{{$tasks->url($i)}}">{{$i}}</a>
                            </li>
                          @endfor
                          
                          <li class="page-item">
                            <a class="page-link" href="{{$tasks->nextPageUrl()}}" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Próximo</span>
                            </a>
                          </li>
                        </ul>
                    </nav>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
