<?php

namespace App\Http\Controllers;
use App\Models\User;



use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'nisn' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed',
        'role' => 'required|string|in:user,admin',
    ]);

    $validated['password'] = bcrypt($validated['password']);
    $user = User::create($validated);
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
}

public function login(Request $request)
{
    $credentials = request(['nama', 'password']);

    if (! $token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
}

protected function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
    ]);
}

function me()
{
    $success = self::authUser();
    if (!$success) {
        return self::sendError('unauthorize', ['message' => 'token invalid!'], 401);
    }
    return self::sendResponse($success, 'profile found!.');
}

}
