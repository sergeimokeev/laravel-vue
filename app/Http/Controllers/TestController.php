<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function anyTest(Request $request, $req): JsonResponse
    {
        dd('123');
        return response()->json([
            'req' => $req,
        ]);
    }
}
