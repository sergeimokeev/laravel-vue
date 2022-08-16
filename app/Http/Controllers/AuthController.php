<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            return response()->json([
                'user' => auth()->user()->load(['roles']),
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ], 422);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
