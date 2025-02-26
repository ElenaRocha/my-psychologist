<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return $this->successResponse(Appointment::all());
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return $this->errorResponse("Cita no encontrada", 404);
        }
        return $this->successResponse($appointment);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pass_id' => 'required|exists:passes,id',
            'booking_id' => 'required|exists:bookings,id',
        ]);

        $appointment = Appointment::create($validated);
        return $this->successResponse($appointment, "Cita creada correctamente", 201);
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return $this->errorResponse("Cita no encontrada", 404);
        }

        $appointment->delete();
        return $this->successResponse(null, "Cita eliminada correctamente", 204);
    }
}
