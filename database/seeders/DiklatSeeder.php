<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiklatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diklats = [
            ['nama_diklat' => 'Diklat Kepemimpinan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_diklat' => 'Diklat Teknis Pengelolaan Keuangan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_diklat' => 'Diklat Fungsional Perencana', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_diklat' => 'Diklat Dasar-Dasar IT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_diklat' => 'Diklat Manajemen Risiko', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('diklats')->insert($diklats);
    }
}
