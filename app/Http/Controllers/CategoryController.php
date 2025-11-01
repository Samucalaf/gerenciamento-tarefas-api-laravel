<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoriesDeleted = $request->query('deleted');
        if ($search) {
            $categories = $this->categoryService->searchCategories($search);
            return CategoryResource::collection($categories);
        }
        if ($categoriesDeleted) {
            $categories = $this->categoryService->getAllDeletedCategories();
            return CategoryResource::collection($categories);
        }
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());
        return new CategoryResource($category);
    }


    public function destroy(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->deleteCategory($category->id);


        return response()->json([
            'message' => 'Excluida com sucesso!',
            'category' => $category
        ]);
    }
}
