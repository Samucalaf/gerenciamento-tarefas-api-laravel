<?php

namespace App\Exceptions;

use Exception;

class CategoryNotFoundException extends Exception
{
    public function __construct(
        public readonly int $categoryId,
        string $message = "",
    ) {
        $message = $message ?? "Category with ID {$this->categoryId} not found.";
        parent::__construct($message);
    }

    public function render()
    {
        return response()->json([
            'category_id' => $this->categoryId,
            'error' => 'Category Not Found',
            'message' => $this->getMessage(),
        ], 404);
    }   
}
