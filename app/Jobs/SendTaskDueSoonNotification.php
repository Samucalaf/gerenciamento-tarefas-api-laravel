<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Task;
use App\Mail\TaskDueSoonMail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTaskDueSoonNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public Task $task
    ) {}

    public function handle(): void
    {
        $user = $this->task->user;

        Mail::to($user->email)
            ->send(new TaskDueSoonMail($this->task));
    }

    public function failed(\Throwable $e): void
    {
        Log::error('Job falhou', [
            'task_id' => $this->task->id,
            'error'  => $e->getMessage(),
        ]);
    }
}