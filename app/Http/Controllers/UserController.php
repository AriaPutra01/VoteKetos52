<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Mendapatkan profil pengguna yang sedang login
    public function profile()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return response()->json($user);
    }

    // Memperbarui profil pengguna
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Validasi input pengguna    
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'string|confirmed|min:8'
        ]);

        // Update profil pengguna
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }
}
