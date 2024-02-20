<?php

namespace App\Http\Controllers;

use App\Models\popularCardJob;
use Illuminate\Http\Request;

class PopularCardJobController extends Controller
{
    public function index()
    {
        return ['status' => true, 'popularCardJob' => popularCardJob::all()];
    }
}
