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
            'title' => 'Alimentação',
            'description' => 'comer 3 mil calorias hoje',
            'completed' => false,
            'priority' => 'high',
            'due_date' => '2025-08-07', 
            'user_id' => 1,
            'category_id' => 1,
        ]);
    }
}
