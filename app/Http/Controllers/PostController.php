<?php

namespace App\Http\Controllers;

use App\Http\Resources\DelightCollection;
use App\Http\Resources\DelightResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        $user = $request->user();
        $followings_user_ids = $user->followings()->pluck('following_id');
        $posts = Post::whereIn('user_id', $followings_user_ids)
            ->orWhere('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

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
        $post = $user->posts();

//        if ($delight->public && !$gourmet->isTasting($delight->gourmet)) {
//            return new DelightResource($delight->load('gourmet'));
//        }
//
//        if ($delight->gourmet_id !== Auth::id() && !$gourmet->isTasting($delight->gourmet)) {
//            return response()->json(['message' => 'Unauthorized'], 403);
//        }

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

    public function like(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if (!$user->isFollowing($post->user)) {
            return response()->json([
                'errors' => ['you are not following this post user']
            ], 403);
        }

        if ($post->isLikeBy($user->id)) {
            return response()->json([
                'errors' => 'you already like post'], 400
            );
        }

        $post->likes()->create(['user_id' => $user->id]);
        return response()->noContent();
    }

    public function unlike(Request $request, Post $post): JsonResponse | Response
    {
        $user = $request->user();

        if (!$user->isFollowing($post->user)) {
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
