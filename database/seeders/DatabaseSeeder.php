<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pass;
use App\Models\Booking;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            Pass::factory(fake()->numberBetween(1, 3))->create(['user_id' => $user->id])->each(function ($pass) {
                Booking::factory(fake()->numberBetween(1, 5))->create(['user_id' => $pass->user_id, 'pass_id' => $pass->id])->each(function ($booking) use ($pass) {
                    Appointment::factory(fake()->numberBetween(1, 2))->create([
                        'pass_id' => $pass->id,
                        'booking_id' => $booking->id,
                    ]);
                });
            });
        });
    }
}