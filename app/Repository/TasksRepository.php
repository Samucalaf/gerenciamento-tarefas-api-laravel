<?php

namespace App\Repository;

use App\Models\Task;


class TasksRepository
{

    protected $model;
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function getByStatus(int $userId, string $status)
    {
        $query = $this->model->where('user_id', $userId);

        if ($status === 'completed') {
            return $query->where('completed', true)->get();
        }

        if ($status === 'pending') {
            return $query->where('completed', false)->get();
        }

        return collect();
    }

    public function searchByTitleOrDescription(int $userId, string $searchTerm)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            })
            ->get();
    }

    public function getByPriority(int $userId, string $priority)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('priority', $priority)
            ->get();
    }

    public function all(int $userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data, $userId)
    {
        $task = $this->model
            ->where('task_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($task) {
            return $task->update($data);
        }

        return false;
    }

    public function delete($id)
    {
        $task = $this->find($id);
        if ($task) {
            return $task->delete();
        }
        return false;
    }
}
