<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function like(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if ($post->isLikeBy($user->id)) {
            return response()->json([
                'errors' => 'you already like post'], 400
            );
        }

        if (!$user->isFollowing($post->user) && !($user->id == $post->user->id)) {
            return response()->json([
                'errors' => ['you are not following this post user']
            ], 403);
        }

        $post->likes()->create(['user_id' => $user->id]);
        return response()->noContent();
    }

    public function unlike(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if (!$user->isFollowing($post->user) || $user->id != $post->user->id) {
            return response()->json([
                'errors' => ['you are not following this post user']
            ], 403);
        }

        $like = $post->likes()->where('user_id', $user->id)->first();

        if (!$like) {
            return response()->json([
                'errors' => ['you are did not like this post'],
            ], 400);
        }

        $like->delete();
        return response()->noContent();
    }
}
