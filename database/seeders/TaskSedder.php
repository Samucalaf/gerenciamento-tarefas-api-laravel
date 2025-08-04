<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Trabalho',
            'description' => 'testando meu seeder',
            'completed' => false,
            'priority' => 'high',
            'due_date' => '2025-08-03', 
            'user_id' => 3,
            'category_id' => 1,
        ]);
    }
}
