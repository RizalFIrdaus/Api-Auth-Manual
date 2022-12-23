<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:6|max:12|unique:users',
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $register = User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'successful register',
                'data' => $register,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed register'
            ], 400);
        }
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $api_key = base64_encode(Str::random(40));
        $user = User::where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $user->update([
                    'api_key' => $api_key
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Successful Login',
                    'data' => $user,
                    'api_key' => $api_key
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Username or password not match'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'User not found!'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $api = explode(' ', $request->header('Authorization'));
        $user = User::where('api_key', $api[1])->first();
        if ($user) {
            $user->update([
                'api_key' => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Successful logout'
        ]);
    }
}
