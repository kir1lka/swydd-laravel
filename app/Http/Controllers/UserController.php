<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $response = (new UserService($request->email, $request->password, $request->name))->register($request->devicename);
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $response = (new UserService($request->email, $request->password))->login($request->devicename);
        return response()->json($response);
    }
    public function logout(Request $request)
    {
        $response = (new UserService())->logout($request->devicename);
        return response()->json($response);
    }
}
