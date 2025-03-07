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
        $posts = Post::where('user_id', $user->id)->get();

//        if ($delight->public && !$gourmet->isTasting($delight->gourmet)) {
//            return new DelightResource($delight->load('gourmet'));
//        }
//
//        if ($delight->gourmet_id !== Auth::id() && !$gourmet->isTasting($delight->gourmet)) {
//            return response()->json(['message' => 'Unauthorized'], 403);
//        }

        return response()->json([
            'posts' => $posts,
        ]);
//        $gourmet = Auth::user();
//
//        $tasting_ids = $gourmet->following()->pluck('taster_id');
//        $tasting_ids->push($gourmet->id);
//
//        $delights = Post::with('gourmet')
//            ->where(function ($query) use ($tasting_ids) {
//                $query->whereIn('gourmet_id', $tasting_ids)
//                    ->orWhere('public', true);
//            })
//            ->orderBy('created_at', 'desc')
//            ->paginate(3);
//
//        return $delights;
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

    public function like(Post $delight): DelightResource|JsonResponse
    {
        $gourmet = Auth::user();

        if ($delight->public && !$gourmet->isTasting($delight->gourmet)) {
            return response()->json(['message' => 'Cannot eat public posts'], 403);
        }

        if ($delight->isEatenBy($gourmet->id)) {
            return response()->json(['message' => 'Delight already eaten'], 400);
        }

        $delight->eats()->create(['gourmet_id' => $gourmet->id]);

        return new DelightResource($delight->load('gourmet', 'eats'));
    }

    public function unlike(Post $delight): DelightResource|JsonResponse
    {
        $gourmet = Auth::user();
        if ($delight->public && !$gourmet->isTasting($delight->gourmet)) {
            return response()->json(['message' => 'Cannot uneat public posts'], 403);
        }

        $eat = $delight->eats()->where('gourmet_id', $gourmet->id)->first();

        if (!$eat) {
            return response()->json(['message' => 'Delight not eaten'], 400);
        }

        $eat->delete();

        return new DelightResource($delight->load('gourmet', 'eats'));
    }
}
