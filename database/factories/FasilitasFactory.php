<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FasilitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_fasilitas' => $this->faker->randomElement([
                'AC Dingin',
                'TV LED 50 inci Ultra HD',
                'PlayStation 5 Original',
                'Wi-Fi Super Cepat',
                'Kamar Mandi Dalam',
                'Speaker Bluetooth',
                'Meja Gaming RGB',
                'Microphone',
                'Nitendo Switch',
            ]),
        ];
    }
}
