<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TaskExport implements FromCollection, WithHeadings, WithMapping
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
            'Tarefa', 
            'Data estimada para conclusão',
        ];
    }

    public function map($row):array
    {
        return [
            $row->id,
            $row->task,
            date('d/m/Y', strtotime($row->date_limit))
        ];
    }
}
