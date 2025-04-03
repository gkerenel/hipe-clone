<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, string $username): JsonResponse | Response
    {

        $user = $request->user();

        $follow = User::where('username', $username)->first();

        if ($user->id === $follow->id)
        {
            return response()->json([
                'errors' => ['can not follow yourself']
            ], 422);
        }

        if ($user->isFollowing($follow))
        {
            return response()->json([
                'errors' => ['already following this user']
            ], 401);
        }

        Follow::create([
            'follower_id' => $user->id,
            'following_id' => $follow->id
        ]);

        return response()->noContent();
    }

    public function unfollow(Request $request, string $username): JsonResponse | Response
    {
        $user = $request->user();
        $follow = User::where('username', $username)->first();

        if ($user->id === $follow->id)
        {
            return response()->json([
                'errors' => ['can not unfollow yourself']
            ], 422);
        }

        if (!$user->isFollowing($follow))
        {
            return response()->json([
                'errors' => ['you are not following this user']
            ], 401);
        }

        Follow::where([
            'follower_id' => $user->id,
            'following_id' => $follow->id
        ])->delete();

        Comment::where('user_id', $user->id)
            ->whereIn('post_id', $follow->posts()->pluck('id'))
            ->delete();

        Like::where('user_id', $user->id)
            ->whereIn('post_id', $follow->posts()->pluck('id'))
            ->delete();



        return response()->noContent();
    }

    public function isFollowing(Request $request, string $username): JsonResponse | Response
    {
        $user = $request->user();
        $follow = User::where('username', $username)->first();

        if (!$user->isFollowing($follow)) {
            return response()->json([], 422);
        }

        return response()->noContent();
    }
}
