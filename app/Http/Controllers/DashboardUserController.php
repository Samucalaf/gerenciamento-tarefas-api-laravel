<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class DashboardUserController extends Controller
{
    public function statisticTaskUser(Request $request)
    {
        $user = $request->user();
        $requestUser = $request->all();


        if (isset($requestUser['category'])) {
            $category = Category::where('user_id', $user->id)
                ->where('name', $requestUser['category'])
                ->with('tasks')
                ->get();

            return response()->json($category);
        }

        if (isset($requestUser['amount'])) {
            $allTasks = Task::where('user_id', $user->id)
                ->get();

            return response()->json($allTasks);
        }
    }


    public function statisticCategory(Request $request)
    {
        $user = $request->user();

        $requestUser = $request->all();

        
        if(isset($requestUser['categories'])){
            $categories = Cache::remember("categories_user_{$user->id}", 600, function() use ($user){
                return Category::where('user_id', $user->id)
                ->whereNull('deleted_at')
                ->get();
            });

            return response()->json([
                'tarefas criadas e ativas',
                $categories
            ]);
        }


    }

    public function statisticUser(Request $request)
    {
        $user = $request->user();
    }
}
