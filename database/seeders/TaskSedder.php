<?php

namespace Database\Seeders;

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
            'title' => 'teste',
            'description' => 'testando minha pesquisa',
            'completed' => false,
            'priority' => 'medium',
            'due_date' => '2025-08-20', 
            'user_id' => 2,
            'category_id' => 1,
        ]);
    }
}
