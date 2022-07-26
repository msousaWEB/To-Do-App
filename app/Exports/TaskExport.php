<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaskExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Task::all();
        return auth()->user()->tasks()->get();
    }

    public function headings():array
    {
        return [
                'ID', 
                'ID Usuário', 
                'Tarefa', 
                'Data estimada para conclusão',
                'Data criação',
                'Data atualização'
        ];
    }
}
