<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user  = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Token inválido'], 401);
        }

        $query = Category::where('user_id', $user->id);
        $status = $request->get('status', 'all');



        if ($request->has('name')) {
            $query = Category::where('name', '=', $request->search['name'])
                ->orderBy('name', 'desc');
        }

        if ($request->has('delete')) {

            $query = Category::onlyTrashed()
                ->orderBy('name', 'desc');
        }

        if ($request->has('description')) {
            $query = Category::where('user_id', $user->id)
                ->where('description', 'like', '%' . $request->search['description'] .  '%')
                ->orderBy('name', 'desc');
        }

        $categories = $query->with('tasks')->orderBy('name', 'asc')->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valideted = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories')->whereNull('deleted_at')
            ],
            'description' => 'required|string|max:100',
        ]);


        $category = Category::create([
            'name' => $valideted['name'],
            'user_id' => $request->user()->id,
            'description' => $valideted['description'] ?? null
        ]);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'required|string|max:100'
        ]);

        $category->update($validated);

        return response()->json($category);
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([

            'Excluida com sucesso!',
            '$category' => $category

        ]);
    }
}
