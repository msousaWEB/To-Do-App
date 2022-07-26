<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .title {
            border: 1px;
            background-color: #c6c6c6;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            padding: 10px;
        }

        .table {
            width: 100%;
        }

        .table th {
            text-align: left;
        }

    </style>
    <title>Lista de Tarefas</title>
</head>
<body>
    <div class="title">Lista de Tarefas</div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Data estimada de conclusão</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $t => $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->task}}</td>
                    <td>{{date('d/m/Y', strtotime($task->date_limit))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="page-break"></div>
    pagina2 --}}
    
</body>
</html>
