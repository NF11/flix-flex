<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginFailedResponse;
use App\Http\Resources\LoginSuccessResponse;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('name', $request->get('name'))->first();

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return new LoginFailedResponse();
        }
        return new LoginSuccessResponse($user);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'password' => $request->get('password')
        ]);
        return new LoginSuccessResponse($user);

    }
}
