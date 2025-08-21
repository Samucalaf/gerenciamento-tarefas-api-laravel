<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class DashboardUserController extends Controller
{
    public function statisticTaskUser(Request $request)
    {
        $user = $request->user();
        $requestUser = $request->all();


        if (isset($requestUser['category'])) {
            $category = Cache::remember("categories_user_{$user->id}", 600, function () use ($user) {

                return Category::where('user_id', $user->id)
                    ->with('tasks')
                    ->get();
            });

            return response()->json($category);
        }
    }


    public function statisticCategory(Request $request)
    {
        $user = $request->user();

        $requestUser = $request->all();


        if (isset($requestUser['categories'])) {
            $categories = Cache::remember("categories_user_{$user->id}", 600, function () use ($user) {
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
        $authUser = $request->user();
        $requestUser = $request->all();



        if (isset($requestUser['Users'])) {

            $value1 = $requestUser['Users'][0];
            $value2 = $requestUser['Users'][1];

            $cacheKey = "users_users_{$value1}_{$value2}";


            $users = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($value1, $value2) {
                return User::whereBetween('created_at', [$value1, $value2])
                    ->get();
            });


            return response()->json($users);
        }
    }
}
