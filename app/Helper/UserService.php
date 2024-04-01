<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserService
{
    public $name, $email, $password;

    public function __construct($email = "", $password = "", $name = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function validateInput($auth = false)
    {
        $rules = [
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'string', Password::min(6)],
        ];

        if ($auth) {
            // $rules['email'][] = 'exists:users';
            // Check if user exists only if authenticating
            $userExists = User::where('email', $this->email)->exists();

            if (!$userExists) {
                return ['status' => false, 'message' => "Учетные данные не совпадают",];
            }

            $rules['email'][] = 'exists:users';
        } else {
            $rules['name'] = ['required', 'string', 'min:4'];
            $rules['email'][] = 'unique:users';
        }

        $validator = Validator::make(
            ['name' => $this->name, 'email' => $this->email, 'password' => $this->password],
            $rules
        );

        $validator->setAttributeNames([
            'email' => 'почта',
            'password' => 'пароль',
            'name' => 'логин',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->messages()];
        } else {
            return ['status' => true];
        }
    }

    public function register($deviceName)
    {
        $validate = $this->validateInput();

        if ($validate['status'] == false) {
            return $validate;
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);

            $token = $user->createToken('outapptoke')->plainTextToken;

            return ['status' => true, 'token' => $token, 'user' => $user];
        }
    }

    public function login($devicename)
    {
        $validate = $this->validateInput(true);

        if ($validate['status'] == false) {
            return $validate;
        } else {
            $user = User::where('email', $this->email)->first();

            if (Hash::check($this->password, $user->password)) {
                $token = $user->createToken('outapptoke')->plainTextToken;
                return ['status' => true, 'token' => $token, 'user' => $user];
            } else {
                return ['status' => false, 'message' => "Учетные данные не совпадают",];
            }
        }
    }
    public function logout($devicename)
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return ['status' => true, 'message' => 'User logged out successfully.'];
    }
}
