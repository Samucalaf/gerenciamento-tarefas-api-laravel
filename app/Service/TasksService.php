<?php

namespace App\Service;


use App\Repository\TasksRepository;
use Illuminate\Support\Facades\Auth;

class TasksService
{
    protected TasksRepository $tasksRepository;

    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function allTasks()
    {
        return $this->tasksRepository->all(Auth::id());
    }

    public function findTaskById($id)
    {
        $task = $this->tasksRepository->find($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return $task;
    }

    public function createTask(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->tasksRepository->create($data);
    }

    public function updateTask($id, array $data)
    {
        $this->findTaskById($id);
        return $this->tasksRepository->update($id, $data);
    }

    public function deleteTask($id)
    {
        return $this->tasksRepository->delete($id);
    }
}
