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

    public function update(Request $request): JsonResponse | Response
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string'],
            'username' => ['nullable', 'string', 'unique:users,username,' . $user->id],
            'email' => ['nullable', 'email', 'unique:users,email,' . $user->id],
            'bio' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ],
                422);
        }

        $user->update($request->only('name', 'username', 'email', 'bio'));
        return response()->noContent();
    }

    public function updatePassword(Request $request): JsonResponse | Response
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current' => ['required', 'string'],
            'password_new' => ['required', 'string', 'min:8', 'max:60', 'confirmed'],
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

        if ($request['current'] == $request['password_new']) {
            return response()->json([
                'errors' => ['current password cannot be same as new password']
            ], 422);
        }

        $user->update(['password' => Hash::make($request['password_new'])]);
        return response()->noContent();
    }
}
