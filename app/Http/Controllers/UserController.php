<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function show(Request $request, User $user): JsonResponse
    {
        $posts = $user->posts;
        return response()->json(['user' => $user, 'posts' => $posts]);
    }
}
