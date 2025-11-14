<?php

namespace App\Service;

use App\Exceptions\UserValidationException;
use App\Mail\TaskCreated;
use App\Repository\TasksRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TasksService
{
    protected TasksRepository $tasksRepository;
    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }
    private function getAuthenticatedUserId(): int
    {
        $userId = Auth::id();
        if ($userId === null) {
            throw new \Exception("User not authenticated.");
        }
        return $userId;
    }
    public function searchTasksByTitleOrDescription(string $searchTerm)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->searchByTitleOrDescription($userId, $searchTerm);
    }
    public function getTasksByStatus(string $status)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->getByStatus($userId, $status);
    }
    public function getTasksByPriority(string $priority)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->getByPriority($userId, $priority);
    }
    public function allTasks()
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->all($userId);
    }
    public function findTaskById($id)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->find($id);
    }
    public function createTask(array $data)
    {
        $data['user_id'] = $this->getAuthenticatedUserId();

        $task = $this->tasksRepository->create($data);
        $user = User::find($data['user_id']);

        if ($user) {
            $email = new TaskCreated(
                $task
            );

            Mail::to($task->user->email)->send($email);
        }


        return $task;
    }
    public function updateTask($id, array $data)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->update($id, $data);
    }
    public function deleteTask($id)
    {
        $userId = $this->getAuthenticatedUserId();
        return $this->tasksRepository->delete($id);
    }
}
