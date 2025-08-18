<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Validation\Rules\Exists;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();


        $tasks = Task::where('user_id', $user->id)
            ->with('category')
            ->orderBy('due_date')
            ->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'priority' => 'nullable|in:low,medium,high',
                'due_date' => 'nullable|date|after_or_equal:today',
                'completed' => 'nullable|boolean',
                'category_id' => 'nullable|integer|exists:categories,id'
            ]);

            $validated['user_id'] = $request->user()->id;

            $task = Task::create($validated);

            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json([
                'Mensagem erro!' => 'Erro ao criar tarefa',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with(['category', 'user'])->findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'nullable|in:low,medium,high',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date|after_or_equal:today'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Tarefa deletada com sucesso',
            $task
        ]);
    }

    public function filter(Request $request)
    {
        $user = $request->user(); //aqui eu pego o usuario logado

        if (!$user) {
            return response()->json(['message' => 'Token inválido ou não fornecido'], 401);
        }

        $search = $request->all(); //onde vem a pesquisa 
        $query = Task::where('user_id', $user->id);  //query base serve para ir acumulando as pesquisas 

        if (empty($search)) {
            return response()->json([
                'message' => 'Campo vazio'
            ], 400);
        }

        if (isset($search['priority'])) {
            $query->where('priority', $search['priority']);
        }

        if (isset($search['title'])) {
            $query->where('title', 'like', '%' . $search['title'] . '%');
        }

        if (isset($search['description'])) {
            $query->where('description', 'like', '%' . $search['description'] . '%');
        }

        $tasks = $query->get();

        if ($tasks->isEmpty()) {
            return response()->json([
                'message' => 'nenhuma tarefa encontrada'
            ]);
        }
        return response()->json($tasks);
    }
}
