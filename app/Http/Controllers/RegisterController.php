<?php

namespace App\Http\Controllers;

use App\Exceptions\RegisterFailedException;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @throws RegisterFailedException
     */
    public function store(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'description' => $data['description'],
        ]);

        if ($newUser) {
            $newUser->roles()->attach(User::AUTHOR_ROLE_ID);

            return response()->json([
                'data' => $newUser,
                'status' => 'success'
            ]);
        }

        throw new RegisterFailedException;
    }
}
