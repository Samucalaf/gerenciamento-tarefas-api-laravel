<?php

namespace App\Exceptions;

use Exception;

class CategoryValidationException extends Exception
{
    public function __construct(
        public readonly int $categoryId,
        string $message = ""
    ) {
        $message = $message ?? "Category with ID {$this->categoryId} is invalid.";
        parent::__construct($message);
    }

    public function render()
    {
        return response()->json([
            'category_id' => $this->categoryId,
            'error' => 'Category Validation Error',
            'message' => $this->getMessage(),
        ], 422);
    }
}
