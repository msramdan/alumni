<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;
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
        // Generate 10 fake data for alumni
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'no_reg' => $i,
                'nama' => 'Alumni ' . $i,
                'tempat_lahir' => 'Kota ' . $i,
                'tanggal_lahir' => Carbon::now()->subYears(20 + $i)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert data into the database
        Alumni::insert($data);
    }
}
