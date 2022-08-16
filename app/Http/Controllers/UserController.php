<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $pageNumber = intval($request->input('page') ?? 1);
        $perPage = intval($request->input('per_page') ?? 10);
        $pageLevel = ($pageNumber - 1) * $perPage;

        $data = User::query();

        $data->when($request->input('authors'), function ($query) {
            $query->withCount(['posts'])
                ->whereHas('roles', function ($q) {
                    $q->where('name', Role::ROLE_AUTHOR);
                });
        });

        $count = $data->count();

        $users = $data->skip($pageLevel)
            ->take($perPage)->get();

        return response()->json([
            'data' => [
                'users' => $users,
                'total_pages' => ceil($count / $perPage),
                'page_number' => $pageNumber
            ],
            'status' => 'success',
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $user->loadCount(['posts'])
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'description' => $data['description']
            ]
        );

        return response()->json([
            'data' => $user,
            'status' => 'success',
            'message' => 'The data has been updated'
        ]);
    }
}
