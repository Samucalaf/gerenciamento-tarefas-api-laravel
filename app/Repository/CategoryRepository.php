<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository
{

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function search(string $term)
    {
        return $this->model->where('name', 'LIKE', "%$term%")
            ->orWhere('description', 'LIKE', "%$term%")
            ->get();
    }

    public function allDeleted()
    {
        return $this->model->onlyTrashed()->with('name', 'asc')->get();
    }
    public function findAll()
    {
        return $this->model->with('tasks')->orderBy('name', 'asc')->get();
    }

    public function findById($id)
    {
        return $this->model->with('tasks')->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $category = $this->model->find($id);
        if ($category) {
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        if ($category) {
            $category->delete();
            return true;
        }
        return false;
    }
}
