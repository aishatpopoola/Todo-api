<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:191',
                'email' => 'required|email|max:191|unique:users',
                'password' => 'required|string|max:20|confirmed',
            ]
        );
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();
        $token = $user->createToken($request->name . 'sign up')->plainTextToken;
        return response(
            [
                'message' => "You have succesfully signed up",
                'username' => $user->name,
                'token' => $token,
            ],
            201
        );
    }

    public function signIn(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|max:191',
                'password' => 'required|string|max:20',
            ]
        );
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => 'Incorrect Credentials.'], 422);
        }

        $token = $user->createToken($user->name . 'sign in')->plainTextToken;

        return response(
            [
                'message' => "You have succesfully signed in",
                'username' => $user->name,
                'token' => $token,
            ],
            200
        );
    }

    public function signOut()
    {
        if (Auth::check()) {
            $user = Auth::user();
            Auth::guard('web')->logout();
            $user->tokens()->delete();
            
            return response(
                [ 'message' => "You have succesfully logged out" ],
                204
            );
        }
    }
}
