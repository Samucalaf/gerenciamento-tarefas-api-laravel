<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('tasks')->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valideted = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'required|string|max:100'
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
            $category

        ]);
    }

    public function filter(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                "Usuario não econtrado!"
            ], 401);
        }

        $search = $request->all();



        if (isset($search['between'])) {
            $value1 = $search['between'][0];
            $value2 = $search['between'][1];
            $result = Category::where('user_id', $user->id)
                ->whereBetween('created_at', [$value1, $value2])
                ->orderBy('created_at', 'desc')
                ->get();

            if ($result->isEmpty()) {
                return response()->json([
                    "message" => "Nenhuma categoria encontrada!"
                ]);
            }
            return response()->json($result);
        }


        if (isset($search['name'])) {
            $result = Category::where('user_id', $user->id)
                ->where('name', '=', $search['name'])
                ->orderBy('name', 'desc')
                ->get();

            if ($result->isEmpty()) {
                return response()->json([
                    "message" => "Nenhuma categoria encontrada!"
                ]);
            }
            return response()->json($result);
        }

        if (isset($search['delete'])) {

            $result = Category::onlyTrashed()
                ->where('user_id', $user->id)
                ->orderBy('name', 'desc')
                ->get();

            if ($result->isEmpty()) {
                return response()->json([
                    "message" => "Nenhuma categoria deletada!"
                ]);
            }

            return response()->json($result);
        }

        if (isset($search['description'])) {
            $result = Category::where('user_id', $user->id)
                ->where('description', 'like', '%' . $search['description'] .  '%')
                ->orderBy('name', 'desc')
                ->get();

            if ($result->isEmpty()) {
                return response()->json([
                    "message" => "Nenhuma categoria encontrada!"
                ]);
            }

            return response()->json($result);
        }
    }
}
