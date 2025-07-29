<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'title' => 'Fazer projeto EzWeb',
            'description' => 'Para melhorar minha aprendizagem',
            'completed' => false,
            'priority' => 'alta',
            'due_data' => now()->addDays(7),
            'category_id' => 1,
        ]);
    }
}
