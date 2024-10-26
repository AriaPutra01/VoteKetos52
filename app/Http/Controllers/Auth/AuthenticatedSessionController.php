<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Generate Sanctum token for API
        $user = $request->user();
        $token = $user->createToken('API Token')->plainTextToken;

        // Return token in response
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // Revoke the current user's token
        $request->user()->currentAccessToken()->delete();

        // Logout from the web guard
        Auth::guard('web')->logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Confirm successful logout
        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}
