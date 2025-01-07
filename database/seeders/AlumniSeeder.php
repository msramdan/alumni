<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Import the Faker library
use Carbon\Carbon;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Create an array to hold the data
        $alumni = [];

        // Generate 120 dummy alumni records
        for ($i = 0; $i < 500; $i++) {
            $alumni[] = [
                'nama' => $faker->name,
                'no_absen' => $i + 1, // Use a sequential number for `no_absen`
                'no_reg' => $faker->unique()->numberBetween(1000, 9999),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date(),
                'photo' => null, // Or use `$faker->imageUrl()` for a random image URL
                'pelaksaan_diklat_id' => $faker->numberBetween(1, 2), // Random pelaksaan_diklat_id, adjust the range if needed
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert the dummy data into the database
        DB::table('alumni')->insert($alumni);
    }
}
