<?php

namespace Database\Seeders\users;

use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{

    public function __construct(
        public readonly UserRepository $userRepository,
    )
    {

    }

    public function run(): void
    {
        $existedUser = $this->userRepository->getByEmail('user@gmail.com');

        if ($existedUser === null) {
            DB::table('users')->insert([
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);


            DB::table('profiles')->insert([
                'first_name' => 'user',
                'last_name' => 'user',
                'user_id' => 3,
            ]);

        }
    }


}
