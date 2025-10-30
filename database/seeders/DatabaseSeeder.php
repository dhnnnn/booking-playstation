<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Image;
use App\Models\Fasilitas;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            FasilitasSeeder::class,
        ]);

        Room::factory(5)
            ->has(Image::factory()->count(3), 'images') // setiap room punya 3 image
            ->hasAttached(Fasilitas::factory()->count(rand(2, 5)), [], 'fasilitas') // setiap room punya 2-5 fasilitas
            ->create();
    }
}
