<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $validatedRequest = $request->validate([
            "email" => "required|email",
            "password" => "required|string",
            "phone" => "required|string",
            "role" => "required|in:driver,client"
        ]);

        $user_role = UserRole::where("name", $validatedRequest["role"])->first();
        $validatedRequest["role_id"] = $user_role->id;
        unset($validatedRequest["role"]);

        $user = User::create($validatedRequest);

        return response($user->getFormattedResponse());
    }


    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response(["error" => "incorrect password"], 401);
        }

        return response(["token" => $user->createToken($request->email)->plainTextToken]);
    }

    public function invalidateToken(Request $request)
    {
        $request->user()->tokens()->delete();

        return response(["message" => "tokens have been removed"]);
    }
}
