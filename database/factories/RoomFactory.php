<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_title' => $this->faker->words(2, true), // contoh: "Deluxe Room"
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->numberBetween(10000, 50000),
            'room_type' => $this->faker->randomElement(['VVIP', 'VIP', 'Raguler']),
        ];
    }

    public function withImages(int $count = 3)
    {
        return $this->has(Image::factory()->count($count), 'images');
    }
}
