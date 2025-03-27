<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(string $username): JsonResponse
    {
        $user = User::where('username', $username)->withCount(['followings', 'followers'])->firstOrFail();

        if (!$user) {
            abort(404);
        }

        return response()->json(['user' => $user]);
    }

    public function search(string $username): JsonResponse
    {
        $users = User::query()
            ->when(
                $username,
                function(Builder $builder) use ($username){
                    $builder->where('name', 'like', "%{$username}%");
                }
            )->get();

        return response()->json(['users' => $users]);
    }
}
