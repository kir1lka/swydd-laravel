<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        // $query = Post::query()
        //     ->select(
        //         'posts.id',
        //         'posts.title_job',
        //         'posts.price',
        //         'posts.experience',
        //         'posts.city',
        //         'posts.published_at',
        //         'posts.logo',
        //         'posts.name_company',
        //         DB::raw('GROUP_CONCAT(DISTINCT tags.title) as tags')
        //     )
        //     ->leftJoin('tag_posts', 'posts.id', '=', 'tag_posts.post_id')
        //     ->leftJoin('tags', 'tag_posts.tag_id', '=', 'tags.id')
        //     ->orderByRaw('posts.published_at DESC')
        //     ->groupBy('posts.id');

        // $sql = $query->toSql();

        // $posts = $query->get();

        // return response()->json([
        //     'status' => true,
        //     'sql' => $sql,
        //     'posts' => $posts,
        // ], 200);

        ////////////////////////////////////////////
        // $tagName1 = 'Программист';
        // $tagName2 = 'Фронтент';

        // $query1 = Post::query()
        //     ->join('tag_posts', 'posts.id', '=', 'tag_posts.post_id')
        //     ->join('tags', 'tag_posts.tag_id', '=', 'tags.id')
        //     ->orderByRaw('posts.published_at DESC')
        //     ->select(['posts.id', 'posts.title_job', 'posts.price', 'posts.experience', 'posts.city', 'posts.published_at', 'posts.logo', 'posts.name_company', 'tags.title as tag_title'])
        //     ->where('tags.title', $tagName1);

        // $query2 = Post::query()
        //     ->join('tag_posts', 'posts.id', '=', 'tag_posts.post_id')
        //     ->join('tags', 'tag_posts.tag_id', '=', 'tags.id')
        //     ->orderByRaw('posts.published_at DESC')
        //     ->select(['posts.id', 'posts.title_job', 'posts.price', 'posts.experience', 'posts.city', 'posts.published_at', 'posts.logo', 'posts.name_company', 'tags.title as tag_title'])
        //     ->where('tags.title', $tagName2);

        // $query = $query1->union($query2);

        // $sql = $query->toSql();

        // $posts = $query->get();

        // return response()->json([
        //     'status' => true,
        //     'sql' => $sql,
        //     'posts' => $posts,
        // ], 200);

        //////////////////////////////
        // $tagName = 'Программист';

        // $query = Post::query()
        //     ->join('tag_posts', 'posts.id', '=', 'tag_posts.post_id')
        //     ->join('tags', 'tag_posts.tag_id', '=', 'tags.id')
        //     ->orderByRaw('posts.published_at DESC')
        //     ->select(['posts.id', 'posts.title_job', 'posts.price', 'posts.experience', 'posts.city', 'posts.published_at', 'posts.logo', 'posts.name_company', 'tags.title as tag_title'])
        //     ->where('tags.title', $tagName);

        // $sql = $query->toSql();
        // $posts = $query->get();

        // return response()->json([
        //     'status' => true,
        //     'sql' => $sql,
        //     'posts' => $posts,
        // ], 200);
        ///////////////////////////
        // $tagName = 'Программист';

        // $query = Post::query()
        //     ->orderByRaw('published_at DESC')
        //     ->with('tags')
        //     ->select(['id', 'title_job', 'price', 'experience', 'city', 'published_at', 'logo', 'name_company'])
        //     ->whereHas('tags', function ($query) use ($tagName) {
        //         $query->where('title', $tagName);
        //     });

        // $sql = $query->toSql();
        // $posts = $query->get();

        // return response()->json([
        //     'status' => true,
        //     'sql' => $sql,
        //     'posts' => $posts,
        // ], 200);

        ///////////////////////
        // $query = Post::query()
        //     ->orderByRaw('published_at DESC')
        //     ->with('tags')
        //     ->select(['id', 'title_job', 'price', 'experience', 'city', 'published_at', 'logo', 'name_company']);

        // $sql = $query->toSql();

        // $posts = $query->get();

        // return response()->json([
        //     'status' => true,
        //     'sql' => $sql,
        //     'posts' => $posts,
        // ], 200);

        ////////////////////////////////
        return [
            'status' => true,
            'posts' => Post::query()
                ->orderByRaw('published_at DESC')
                ->with('tags')
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
