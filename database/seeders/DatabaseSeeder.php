<?php

namespace Database\Seeders;

use Database\Seeders\users\AdminSeeder;
use Database\Seeders\users\ManagerSeeder;
use Database\Seeders\users\RoleSeeder;
use Database\Seeders\users\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ManagerSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
