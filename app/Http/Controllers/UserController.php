<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("Usuario no encontrado", 404);
        }
        return $this->successResponse($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("Usuario no encontrado", 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'telphone' => 'sometimes|string',
            'role' => 'sometimes|in:admin,client',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return $this->successResponse($user, "Usuario actualizado correctamente");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse("Usuario no encontrado", 404);
        }

        $user->delete();
        return $this->successResponse(null, "Usuario eliminado correctamente", 204);
    }
}
