<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function profile(Request $request)
    {
        return response()->json(
            $request->user()->only(['name', 'email'])
        );
    }
}
