<?php

namespace Database\Seeders\users;

use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    protected $array = [
        AdminSeeder::class,
        ManagerSeeder::class,
        UserSeeder::class,
    ];


    public function run(): void
    {
        foreach ($this->array as $seeder) {
            $this->call($seeder);
        }
    }

}
