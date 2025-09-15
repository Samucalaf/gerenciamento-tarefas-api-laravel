<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Academia',
            'description' => 'Mudar meu treino para um push e pull',
            'completed' => false,
            'priority' => 'high',
            'due_date' => '2025-08-20', 
            'user_id' => 2,
            'category_id' => 2,
        ]);
    }
}
