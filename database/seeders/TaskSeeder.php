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
            'completed' => true,
            'priority' => 'high',
            'due_date' => '2025-09-30', 
            'user_id' => 2,
            'category_id' => 1,
        ]);
    }
}
