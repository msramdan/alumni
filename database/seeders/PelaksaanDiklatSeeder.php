<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelaksaanDiklatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelaksaanDiklats = [
            [
                'diklat_id' => 1, // Pastikan ID ini sesuai dengan data di tabel `diklats`
                'judul_diklat' => 'Diklat kepemimpinan tingkat 1 di level kota/kabupaten',
                'angkatan' => 'I',
                'tanggal_mulai' => '2025-01-10',
                'tanggal_selesai' => '2025-01-15',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'diklat_id' => 2, // Pastikan ID ini sesuai dengan data di tabel `diklats`
                'judul_diklat' => 'Diklat Teknis Pengelolaan Keuangan APBN kabupaten',
                'angkatan' => 'II',
                'tanggal_mulai' => '2025-02-05',
                'tanggal_selesai' => '2025-02-10',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('pelaksaan_diklats')->insert($pelaksaanDiklats);
    }
}
