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
    public function store(Request $request, Post $post): Response
    {
        $user = $request->user();

        if ($post->public && !$gourmet->isTasting($post->gourmet)) {
            return response()->json(['message' => 'Nibbles are disabled on public delights'], 403);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $nibble = $post->nibbles()->create([
            'gourmet_id' => Auth::id(),
            'content' => $request['content'],
        ]);

        return new NibbleResource($nibble->load('gourmet'));
    }

    public function show(Comment $nibble): NibbleResource
    {
        return new NibbleResource($nibble->load('gourmet', 'delight'));
    }

    public function update(Request $request, Comment $nibble): JsonResponse|NibbleResource
    {
        if ($nibble->gourmet_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'string',
        ]);

        $nibble->update($request->only('content'));

        return new NibbleResource($nibble->load('gourmet', 'delight'));
    }

    public function destroy(Comment $nibble): JsonResponse
    {
        if ($nibble->gourmet_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $nibble->delete();

        return response()->json(['message' => 'Nibble deleted']);
    }

}
