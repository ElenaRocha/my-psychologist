<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pass;
use App\Models\Booking;
use App\Models\Appointment;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'pass_id' => Pass::factory(),
            'booking_id' => Booking::factory(),
        ];
    }
}
