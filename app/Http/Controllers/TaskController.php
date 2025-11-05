<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\TasksService;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Http\Resources\TasksResource;

class TaskController extends Controller
{
    protected TasksService $tasksService;

    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $priority = $request->query('priority');

        if ($search) {
            $tasks = $this->tasksService->searchTasksByTitleOrDescription($search);
            return TasksResource::collection($tasks);
        }

        if ($status) {
            $tasks = $this->tasksService->getTasksByStatus($status);
            return TasksResource::collection($tasks);
        }

        if ($priority) {
            $tasks = $this->tasksService->getTasksByPriority($priority);
            return TasksResource::collection($tasks);
        }

        $tasks = $this->tasksService->allTasks();
        return TasksResource::collection($tasks);
    }
    public function store(StoreTasksRequest $request)
    {
        $task = $this->tasksService->createTask($request->validated());
        return new TasksResource($task);
    }

    public function show(string $id)
    {
        $task = $this->tasksService->findTaskById($id);
        return new TasksResource($task);
    }

    public function update(UpdateTasksRequest $request, string $id)
    {
        $this->tasksService->updateTask($id, $request->validated());
        $task = $this->tasksService->findTaskById($id);
        return new TasksResource($task);
    }

    public function destroy(string $id)
    {
        $this->tasksService->deleteTask($id);
        return response()->noContent();
    }
}
