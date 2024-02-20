<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return [
            'status' => true,
            'posts' => Post::query()
                ->orderByRaw('published_at DESC')
                ->get(['id', 'title_job', 'price', 'experience', 'city', 'published_at', 'logo', 'name_company'])
        ];
    }
    public function show($postId)
    {
        return ['status' => true, 'posts' => Post::query()->findOrFail($postId)];
    }
}
