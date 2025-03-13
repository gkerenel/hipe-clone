<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user()->loadCount(['followers', 'followings'])
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string'],
            'username' => ['nullable', 'string', 'unique:users,username,' . $user->id],
            'email' => ['nullable', 'string', 'unique:users,email,' . $user->id],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ],
                422);
        }

        $user->update($request->only('name', 'username', 'email', 'bio', 'photo'));
        return response()->json([
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request): JsonResponse | Response
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current' => ['required', 'string', 'min:8', 'max:255'],
            'new' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        if (!Hash::check($request['current'], $user->password)) {
            return response()->json([
                'errors' => ['invalid current password']
            ], 401);
        }

        if ($request['current'] == $request['new']) {
            return response()->json([
                'errors' => ['current password cannot be same as new password']
            ], 401);
        }

        $user->update(['password' => Hash::make($request['new'])]);
        return response()->noContent();
    }
}
