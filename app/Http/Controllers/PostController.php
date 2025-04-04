<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function show(Request $request) : JsonResponse
    {
        $user = $request->user();
        $followingIds = $user->followings()->pluck('following_id');

        $posts = Post::whereIn('user_id', $followingIds->push($user->id))
            ->with(['comments.user', 'user'])
            ->withCount('likes')
            ->latest()
            ->get()
            ->map(function ($post) use ($user) {
                $post->is_liked = $post->likes()->where('user_id', $user->id)->exists();
                return $post;
            });

        return response()->json([
            'posts' => $posts
        ]);
    }

    public function index(Request $request, Post $post) : JsonResponse
    {
        return response()->json([
            'post' => $post
        ]);
    }

    public function store(Request $request) : JsonResponse | Response
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'body' => ['required', 'string', 'max:1024'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        Post::create([
            'user_id' => $user->id,
            'body' => $request['body'],
        ]);

        return response()->noContent();
    }

    public function update(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if ($post->user_id !== $user->id) {
            return response()->json([
                'errors' => ['you do not own post']
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'body' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $post->update($request->only('body'));
        return response()->noContent();
    }

    public function delete(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if ($post->user->id != $user->id) {
            return response()->json([
                'errors' => ['you do not own post']
            ], 403);
        }

        $post->delete();
        return response()->noContent();
    }
}
