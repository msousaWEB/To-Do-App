<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;
    public $task;
    public $date_limit;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task         = $task->task;
        $this->date_limit   = date('d/m/Y', strtotime($task->date_limit));
        $this->url          = 'http://localhost:8000/task/'.$task->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-task')->subject('Nova tarefa criada!');
    }
}
