<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index($userId)
    {
        $responses = Response::whereHas('user_resume', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('status_response')->get();

        $responses->load('user_resume.resume');
        $responses->load('post.tags');

        return response()->json(['data' => $responses], 200);
    }
    public function store(Request $request)
    {
        $response = Response::create([
            'date' => $request->date,
            'user_resume_id' => $request->user_resume_id,
            'status_response_id' => $request->status_response_id,
            'post_id' => $request->post_id
        ]);

        return response()->json(['data' => $response], 201);
    }
    public function destroy(Response $response)
    {
        $response->delete();

        return response('', 204);
    }
}
