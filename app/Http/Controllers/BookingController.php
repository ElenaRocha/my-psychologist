<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return $this->successResponse(Booking::all());
    }

    public function show($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return $this->errorResponse("Reserva no encontrada", 404);
        }
        return $this->successResponse($booking);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pass_id' => 'nullable|exists:passes,id',
            'booking_date' => 'required|date',
            'paid' => 'boolean',
        ]);

        $booking = Booking::create($validated);
        return $this->successResponse($booking, "Reserva creada correctamente", 201);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return $this->errorResponse("Reserva no encontrada", 404);
        }

        $booking->delete();
        return $this->successResponse(null, "Reserva eliminada correctamente", 204);
    }
}
