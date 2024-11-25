<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(MasjidSeeder::class);
        $this->call(ImamSeeder::class);
        $this->call(ShalatSeeder::class);
    }
}
