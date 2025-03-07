<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:2', 'max:255', 'unique:gourmets'],
            'email' => ['required', 'email', 'unique:gourmets'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray()
            ], 422);
        }

        $gourmet = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $gourmet->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function signin(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:2', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray()
            ], 422);
        }

        $gourmet = User::where('username', $request['username'])->first();

        if (!$gourmet || !Hash::check($request['password'], $gourmet->password)) {
            return response()->json([
                'errors' => ['invalid username or password']
            ], 401);
        }

        $token = $gourmet->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    public function signout(Request $request): Response
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }
}
