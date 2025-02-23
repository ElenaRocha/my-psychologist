<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User making the booking
            $table->foreignId('pass_id')->nullable()->constrained()->onDelete('set null'); // Can be null if no pass is used
            $table->dateTime('booking_date');
            $table->boolean('paid')->default(false); // True if paid individually
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
