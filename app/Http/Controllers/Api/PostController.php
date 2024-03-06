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
                ->with('tags') //связь в post ммодели
                ->get(['id', 'title_job', 'price', 'experience', 'city', 'published_at', 'logo', 'name_company'])
        ];
    }
    public function show($postId)
    {
        $post = Post::query()
            ->with('tags')
            ->findOrFail($postId);

        return $response = [
            'status' => true,
            'posts' => $post
        ];
        // return ['status' => true, 'posts' => Post::query()->findOrFail($postId)];
    }
}
