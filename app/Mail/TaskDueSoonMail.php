<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class TaskDueSoonMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Task $task
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tarefa vencendo em breve: ' . $this->task->title,
        );
    }

    public function content(): Content
    {
        $dueDate = $this->task->due_date instanceof \Carbon\Carbon
            ? $this->task->due_date->copy()->startOfDay()
            : \Carbon\Carbon::parse($this->task->due_date)->startOfDay();

        $today = now()->startOfDay();
        $daysLeft = $today->diffInDays($dueDate, false); 

        return new Content(
            markdown: 'emails.task-due-soon',
            with: [
                'task'     => $this->task,
                'dueDate'  => $dueDate->format('d/m/Y'),
                'daysLeft' => $daysLeft,
            ]
        );
    }
}