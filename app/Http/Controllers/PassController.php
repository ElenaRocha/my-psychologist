<?php

namespace App\Http\Controllers;

use App\Models\Pass;
use Illuminate\Http\Request;

class PassController extends Controller
{
    public function index()
    {
        return $this->successResponse(Pass::all());
    }

    public function show($id)
    {
        $pass = Pass::find($id);
        if (!$pass) {
            return $this->errorResponse("Bono no encontrado", 404);
        }
        return $this->successResponse($pass);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_sessions' => 'required|integer|min:1',
        ]);

        $pass = Pass::create([
            'user_id' => $validated['user_id'],
            'total_sessions' => $validated['total_sessions'],
            'remaining_sessions' => $validated['total_sessions'],
            'purchase_date' => now(),
        ]);

        return $this->successResponse($pass, "Bono creado correctamente", 201);
    }

    public function destroy($id)
    {
        $pass = Pass::find($id);
        if (!$pass) {
            return $this->errorResponse("Bono no encontrado", 404);
        }

        $pass->delete();
        return $this->successResponse(null, "Bono eliminado correctamente", 204);
    }
}
