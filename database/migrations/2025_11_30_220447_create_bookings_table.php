<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('booking_code')->unique();

            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email');
            
            $table->string('room_id');
            $table->string('unit_id');

            $table->date('booking_date');
            $table->time('booking_time');
            $table->integer('duration');

            $table->integer('room_price');
            $table->integer('addons_price')->default(0);
            $table->integer('total_price');
            $table->integer('dp_amount');
            
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('payment_type')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
