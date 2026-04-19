<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendTaskDueSoonNotification;
use App\Models\Task;

class NotifyDueTasks extends Command
{
    protected $signature   = 'tasks:notify-due {--days=2}';
    protected $description = 'Envia notificação de tarefas vencendo em breve';

    public function handle(): void
    {
        $days = (int) $this->option('days');

        $tasks = Task::query()
            ->where('completed', 0)         
            ->whereNull('notified_at')
            ->whereBetween('due_date', [
                now()->startOfDay(),
                now()->addDays($days)->endOfDay(),
            ])
            ->with('user')
            ->get();
        foreach ($tasks as $task) {
            SendTaskDueSoonNotification::dispatch($task);

            $task->update(['notified_at' => now()]);
        }

        $this->info("Disparados {$tasks->count()} Jobs.");
    }
}