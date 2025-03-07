<?php

namespace App\Http\Controllers;

use App\Http\Resources\DelightCollection;
use App\Http\Resources\DelightResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        $gourmet = Auth::user();

        $tasting_ids = $gourmet->tasting()->pluck('taster_id');
        $tasting_ids->push($gourmet->id);

        $delights = Post::with('gourmet')
            ->where(function ($query) use ($tasting_ids) {
                $query->whereIn('gourmet_id', $tasting_ids)
                    ->orWhere('public', true);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return $delights;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'public' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $delight = Post::create([
            'gourmet_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request['content'],
            'public' => $request->input('public', false),
        ]);

        return $delight;
    }

    public function show(Post $delight): DelightResource|JsonResponse
    {
        $gourmet = Auth::user();

        if ($delight->public && !$gourmet->isTasting($delight->gourmet)) {
            return new DelightResource($delight->load('gourmet'));
        }

        if ($delight->gourmet_id !== Auth::id() && !$gourmet->isTasting($delight->gourmet)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new DelightResource($delight->load('gourmet', 'nibbles', 'eats'));
    }

    public function update(Request $request, Post $delight): DelightResource|JsonResponse
    {
        if ($delight->gourmet_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'public' => 'boolean',
        ]);

        $delight->update($request->only('title', 'content', 'public'));

        return new DelightResource($delight->load('gourmet'));
    }

    public function destroy(Post $delight): JsonResponse
    {
        if ($delight->gourmet_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $delight->delete();

        return response()->json(['message' => 'Delight deleted']);
    }

    public function eat(Post $delight): DelightResource|JsonResponse
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

    public function spit(Post $delight): DelightResource|JsonResponse
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
