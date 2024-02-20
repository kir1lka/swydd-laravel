<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $this->_token($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:100',
        ]);

        //check if email exist
        $user = User::where('email', $request->email)->first();

        //check if password match
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Учетные данные не совпадают'
            ]);
        }

        return $this->_token($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response('Пользователь успешно вышел из системы', 200);
    }

    protected function _token($user)
    {
        $token = $user->createToken('outapptoke')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return response($response, 201);
    }
}
