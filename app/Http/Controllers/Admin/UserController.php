<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers(): JsonResponse
    {
        return response()->json([
            'data' => User::with(['roles'])
                ->orderBy('id')
                ->get()->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'created_at' => $user->created_at->format('H:i d-m-Y'),
                        'updated_at' => $user->updated_at->format('H:i d-m-Y'),
                        'roles' => $user->roles->pluck('name')
                    ];
                })
        ]);
    }

    public function storeUser(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($newUser) {
            return response()->json([
                'data' => $newUser,
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ]);
    }

    public function showUser(User $user): JsonResponse
    {
        return response()->json([
            'data' => $user
        ]);
    }

    public function destroyUser(User $user): JsonResponse
    {
        $user->delete();

        if (!$user) {
            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ]);
    }

    public function updateUser(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json([
            'data' => $user,
            'status' => 'success'
        ]);
    }
}
