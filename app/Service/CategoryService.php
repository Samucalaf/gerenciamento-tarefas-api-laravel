<?php

namespace App\Service;
use App\Exceptions\CategoryNotFoundException;
use App\Exceptions\CategoryHasTasksException;
use App\Repository\CategoryRepository;
use Illuminate\Support\Facades\Auth;



class CategoryService {
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->findAll();
    }

    public function searchCategories(string $term)
    {
        return $this->categoryRepository->search($term);
    }

    public function createCategory(array $data)
    {
        if ($data['name'] === null || $data['description'] === null) {
            throw new \Exception("Name and Description are required.");
        }
        $userId = Auth::id();
        $data['user_id'] = $userId;
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;
        return $this->categoryRepository->create($data);
    }
    
    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            throw new \Exception("Category not found.");
        }
        return $category;
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return new CategoryNotFoundException($id);
        }

        if ($data['name'] === null || $data['description'] === null) {
            throw new \Exception("Name and Description are required.");
        }

        $data['updated_by'] = Auth::id();

        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return new CategoryNotFoundException($id);
        }

        if ($category->tasks()->count() > 0) {
            throw new CategoryHasTasksException($category->id, $category->tasks()->count());
        }
        return $this->categoryRepository->delete($id);
    }

    public function getAllDeletedCategories()
    {
        return $this->categoryRepository->allDeleted();
    }
}