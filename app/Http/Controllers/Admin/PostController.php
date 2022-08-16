<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(): JsonResponse
    {
        return response()->json([
            'data' => Post::orderByDesc('updated_at')->with(['user'])->get()
        ]);
    }

    public function storePost(StorePostRequest $request): JsonResponse
    {
        $newPost = Post::create($request->validated());

        if ($newPost) {
            return response()->json([
                'data' => $newPost,
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ]);
    }

    public function showPost(Post $post): JsonResponse
    {
        return response()->json([
            'data' => $post
        ]);
    }

    public function destroyPost(Post $post): JsonResponse
    {
        $post->delete();

        if (!$post) {
            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ]);
    }

    public function updatePost(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());

        return response()->json([
            'data' => $post,
            'status' => 'success'
        ]);
    }
}
