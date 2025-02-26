<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return $this->successResponse([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], "Registro exitoso", 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->errorResponse("Credenciales incorrectas", 401);
        }

        $user = Auth::user();
        return $this->successResponse([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ], "Inicio de sesión exitoso");
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->successResponse(null, "Cierre de sesión exitoso", 200);
    }
}
