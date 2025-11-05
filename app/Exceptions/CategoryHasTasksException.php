<?php

namespace App\Exceptions;

use Exception;

class CategoryHasTasksException extends Exception
{
    public function __construct(
        public readonly int $categoryId,
        public readonly int $tasksCount
    ) {
        parent::__construct("Category {$categoryId} has {$tasksCount} tasks");
    }


    public function render($request)
    {
        return response()->json([
            'error' => 'Category has associated tasks',
            'category_id' => $this->categoryId,
            'tasks_count' => $this->tasksCount
        ], 422);
    }
}
