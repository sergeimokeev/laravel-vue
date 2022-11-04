<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $pageNumber = intval($request->input('page') ?? 1);
        $perPage = intval($request->input('per_page') ?? 9);
        $pageLevel = ($pageNumber - 1) * $perPage;
        $searchQuery = $request->input('query') ?? '';
        $sortBy = $request->input('sort') ?? 'created_at';
        $userId = $request->input('user_id') ?? null;

        $data = Post::where('is_published', true)
            ->with('user');

        $data->when($searchQuery, function ($query) use ($searchQuery) {
            $query->where('title', 'ilike', '%' . $searchQuery . '%')
                ->orWhere('body', 'ilike', '%' . $searchQuery . '%')
                ->orWhere('preview', 'ilike', '%' . $searchQuery . '%')
                ->orWhereHas('user', function ($q) use ($searchQuery) {
                    $q->where('name', 'ilike', '%' . $searchQuery . '%');
                });
        });

        $data->when($userId, function ($query) use ($userId) {
            $query->whereHas('user', function ($q) use ($userId) {
                $q->where('id', $userId);
            });
        });

        $data->when($sortBy, function ($query) use ($sortBy) {
            $query->orderBy($sortBy, ($sortBy == 'created_at') ? 'desc' : 'asc');
        });

        $count = $data->count();

        $posts = $data->skip($pageLevel)
            ->take($perPage)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'posts' => $posts,
                'total_pages' => ceil($count / $perPage),
                'page_number' => $pageNumber
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'unique:posts', 'max:100'],
            'body' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->messages()->all()
            ])->setStatusCode(422);
        }

        $post = Post::create($validator->validated());

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $post->load(['user'])
        ]);
    }

    public function setLikeValue(Post $post, LikeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $like = Like::query()
            ->where([
                'user_id' => $data['user_id'],
                'post_id' => $data['post_id']
            ]);

        if ($like->exists()) {
            $like->delete();

            return response()->json([
                'status' => 'success',
            ]);
        }

        $newLike = Like::create([
                'user_id' => $data['user_id'],
                'post_id' => $data['post_id'],
            ]
        );

        return response()->json([
            'status' => 'success',
            'data' => $newLike
        ]);
    }
}
