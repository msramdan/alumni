<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $alumni = [
            [
                'nama' => 'Ahmad Fauzi',
                'no_absen' => 1,
                'no_reg' => 1001,
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-05-15',
                'photo' => null,
                'pelaksaan_diklat_id' => 1, // Pastikan ID ini sesuai dengan data di tabel `pelaksaan_diklats`
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'no_absen' => 2,
                'no_reg' => 1002,
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-07-20',
                'photo' => null,
                'pelaksaan_diklat_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Rahmat Hidayat',
                'no_absen' => 3,
                'no_reg' => 1003,
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1989-03-10',
                'photo' => null,
                'pelaksaan_diklat_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Dewi Lestari',
                'no_absen' => 4,
                'no_reg' => 1004,
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1995-08-25',
                'photo' => null,
                'pelaksaan_diklat_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('alumni')->insert($alumni);
    }
}
