<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use App\Models\Resume;
use App\Models\User_resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    public function index($userId)
    {
        $userResumes = User_resume::where('user_id', $userId)->with('resume')->get();

        return response()->json(['data' => $userResumes], 202);
    }

    public function store(StoreResumeRequest $request, $userId)
    {
        $validated = $request->validated();

        $resume = Resume::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'last_name' => $validated['last_name'],
            'city' => $validated['city'],
            'date_of_birtday' => $validated['date_of_birtday'],
            'phone' => $validated['phone'],
            'title' => $validated['title'],
            'nationality' => $validated['nationality'],
            'experience' => $validated['experience'],
            'education' => $validated['education'],
        ]);

        $userResume = User_resume::create([
            'user_id' => $userId,
            'resume_id' => $resume->id,
        ]);

        return response()->json(['message' => 'Резюме было успешно создано!', 'data' => $resume], 201);
    }
    public function upgrade(UpdateResumeRequest $request, Resume $resume)
    {
        $validated = $request->validated();

        $resume->update($validated);

        return response()->json(['message' => 'Resume updated successfully'], 200);
    }
    public function destroy(Resume $resume)
    {
        // User_resume::where('resume_id', $resume["id"])->delete();

        // $resume->delete();

        // return response('', 204);

        $resume->responses()->delete();
        $resume->userResumes()->delete();
        $resume->delete();

        return response('', 204);
    }
    public function show($userId, $resumeId)
    {
        $resume = Resume::where('id', $resumeId)->get();

        return response()->json(['data' => $resume], 202);
    }
}
