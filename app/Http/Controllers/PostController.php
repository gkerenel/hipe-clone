<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        $user = $request->user();
        $posts = $user->posts();
        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function store(Request $request) : JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'body' => ['required', 'string'],
            'photo' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $post = Post::create([
            'user_id' => $user->id,
            'body' => $request['body'],
            'photo' => $request['photo'],
        ]);

        return response()->json([
            'post' => $post,
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        $post = $user->posts()->withCounts(['likes']);

        return response()->json([
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $user = $request->user();

        if ($post->user_id !== $user->id) {
            return response()->json([
                'errors' => ['you do not own post']
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'body' => ['nullable', 'string'],
            'photo' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $post->update($request->only('body', 'photo'));

        return response()->json([
            'post' => $post,
        ]);
    }

    public function delete(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if ($post->user_id !== $user->id) {
            return response()->json([
                'errors' => ['you do not own post']
            ], 403);
        }

        $post->delete();
        return response()->noContent();
    }
}
