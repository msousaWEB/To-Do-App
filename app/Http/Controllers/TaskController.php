<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Exports\TaskExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $tasks = Task::where('user_id', $user_id)->paginate(5);
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'task' => 'required|min:3|max:200',
            'date_limit' => 'date',
        ];
        $feedback = [
            'required' => 'Por favor, insira algum texto para tarefa!',
            'task.min' => 'É nescessário conter no mínimo 3 caracteres.',
            'task.max' => 'É nescessário conter no máximo 200 caracteres.',
        ];

        $request->validate($rules, $feedback);
        $receiver = auth()->user()->email;

        $data = $request->all('task', 'date_limit');
        $data['user_id'] = auth()->user()->id;
        
        $task = Task::create($data);
        Mail::to($receiver)->send(new NewTaskMail($task));
        
        return redirect()->route('task.show', ['task' => $task]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if($task->user_id != auth()->user()->id){
            return view('access-denied');
        };

        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $rules = [
            'task' => 'required|min:3|max:200',
            'date_limit' => 'date',
        ];
        $feedback = [
            'required' => 'Por favor, insira algum texto para tarefa!',
            'task.min' => 'É nescessário conter no mínimo 3 caracteres.',
            'task.max' => 'É nescessário conter no máximo 200 caracteres.',
        ];

        $request->validate($rules, $feedback);
        $task->update($request->all());

        
        if($task->user_id != auth()->user()->id){
            return view('access-denied');
        };

        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->user_id != auth()->user()->id){
            return view('access-denied');
        };
        $task->delete();

        return redirect()->route('task.index');
    }

    public function export($extension) 
    {
        
        if(in_array($extension, ['xlsx', 'csv', 'pdf'])){
            return Excel::download(new TaskExport, 'task_list.'.$extension);
        } else {
            return redirect()->route('task.index');
        }

    }

    public function exporting() 
    {
        $tasks = auth()->user()->tasks()->get();

        $pdf = PDF::loadView('task.pdf', ['tasks' => $tasks]);
        // return $pdf->download('task_list.pdf');
        return $pdf->stream('task_list.pdf');
    }
}
