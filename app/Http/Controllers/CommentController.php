<?php

namespace App\Http\Controllers;

use App\Http\Resources\NibbleCollection;
use App\Http\Resources\NibbleResource;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): Response | JsonResponse
    {
        $user = $request->user();

        if (!$user->isFollowing($post->user) && !($user->id == $post->user->id)) {
            return response()->json([
                'errors' => ['you are not following this post'],
            ], 403);
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => $user->id,
            'body' => $request['body'],
        ]);

        return response()->noContent();
    }

    public function show(Request $request, Post $post): JsonResponse
    {
        $user = $request->user();

        if (!$user->isFollowing($post->user) && !($user->id == $post->user->id)) {
            return response()->json([
                'errors' => ['you are not following this post'],
            ], 403);
        }

        return response()->json([
            'comments' => $post->comments
        ]);
    }

    public function update(Request $request, Comment $comment): JsonResponse | Response
    {
        $user = $request->user();

        if ($comment->user_id !== $user->id) {
            return response()->json(['errors' => 'Unauthorized'], 403);
        }

        $request->validate([
            'body' => 'string',
        ]);

        $comment->update($request->only('body'));
        return response()->noContent();
    }

    public function delete(Request $request, Comment $comment): JsonResponse | Response
    {
        $user = $request->user();

        if ($comment->user_id !== $user->id) {
            return response()->json(['errors' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->noContent();
    }

}
