<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate(rules: [
            'nisn' => 'required|nisn|exists:users,nisn',
            'password' => 'required|string|min:6'
        ], 
        params:[
            'nisn.required' => 'nisn wajib diisi!',
            'nisn.nisn' => 'input bukan format nisn!',
            'nisn.exists' => 'nisn tidak terdaftar!',
        ]);

        $credentials = request(['nisnl', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'data' => [
                    'errors' => 'wrong email or password!'
                ]
            ], 401);
        }

        $success = self::respondWithToken($token);
        //return $success;

        return self::sendResponse($success->original, 'User login successfully.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy()
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 14400
        ]);
    }
}
