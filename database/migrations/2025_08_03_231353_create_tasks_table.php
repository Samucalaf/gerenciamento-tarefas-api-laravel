<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('title', 50);
            $table->index('title', 'title_idx');
            $table->string('description', 500);
            $table->index('description', 'description_task_idx');
            $table->boolean('completed');
            $table->string('priority', 10);
            $table->date('due_date');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users', 'user_id');
            $table->index('created_by', 'created_by_idx');
            $table->index('updated_by', 'updated_by_idx');
            $table->foreignId('updated_by')->nullable()->constrained('users', 'user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
