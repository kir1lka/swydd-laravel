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

        return response()->json(['data' => $responses], 200);
    }
}
