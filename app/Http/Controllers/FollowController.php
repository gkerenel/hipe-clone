<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $other): JsonResponse | Response
    {
        $user = $request->user();
        logger('checking follow have:');
        logger(var_export($other, true));

        if ($user->id === $other->id)
        {
            return response()->json([
                'errors' => ['can not follow yourself']
            ], 422);
        }

        if ($user->isFollowing($other->id))
        {
            return response()->json([
                'errors' => ['already following this user']
            ], 401);
        }

        $follow = Follow::create([
            'follower_id' => $user->id,
            'following_id' => $other->id
        ]);

        return response()->noContent();
    }

    public function unfollow(Request $request, User $other): JsonResponse | Response
    {
        $user = $request->user();

        if ($user->id === $other->id)
        {
            return response()->json([
                'errors' => ['can not unfollow yourself']
            ], 422);
        }

        if (!$user->isFollowing($other->id))
        {
            return response()->json([
                'errors' => ['you are not following this user']
            ], 401);
        }

        Follow::where([
            'follower_id' => $user->id,
            'following_id' => $other->id
        ])->delete();

        return response()->noContent();
    }
}
