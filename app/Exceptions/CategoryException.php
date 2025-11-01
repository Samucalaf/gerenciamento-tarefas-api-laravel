<?php

namespace App\Exceptions;

use Exception;

abstract class CategoryException extends Exception
{
    protected int $categoryId;

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}


class CategoryNotFoundException extends CategoryException {}
class CategoryHasTasksException extends CategoryException {}
class CategoryValidationException extends CategoryException {}
