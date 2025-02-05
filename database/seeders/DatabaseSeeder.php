<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(DiklatSeeder::class);
        $this->call(PelaksaanDiklatSeeder::class);
        $this->call(AlumniSeeder::class);
    }
}
