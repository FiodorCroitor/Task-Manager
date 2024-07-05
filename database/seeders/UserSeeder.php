<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $existedUser = User::query()->where('email', 'user@email.com')->first();
        if ($existedUser === null) {

            $name = 'Fiodor' . '-' . 'Croitor';

            User::create([
                'prepayment_sum' => 0,
                'name' => $name,
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'id' => 1,
            ]);
            Profile::create([
                'first_name' => 'Fiodor',
                'last_name' => 'Croitor',
                'user_id' => 1,
            ]);
        }
    }
}
