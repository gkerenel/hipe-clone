<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function taste(User $gourmet): JsonResponse
    {
        if (Auth::id() === $gourmet->id) {
            return response()->json(['message' => 'Cannot follow yourself'], 400);
        }

        if (Auth::user()->isTasting($gourmet)) {
            return response()->json(['message' => 'Already following this gourmet'], 400);
        }

        Auth::user()->tasting()->attach($gourmet->id);

        return response()->json(['message' => 'Successfully followed gourmet']);
    }

    public function spit(User $gourmet): JsonResponse
    {
        if (Auth::user()->isTasting($gourmet)) {
            Auth::user()->tasting()->detach($gourmet->id);
            return response()->json(['message' => 'Successfully unfollowed gourmet']);
        }

        return response()->json(['message' => 'Not following this gourmet'], 400);
    }
}
