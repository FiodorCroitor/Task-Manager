<?php

namespace Database\Seeders\users;

use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use voku\helper\ASCII;

final class AdminSeeder extends Seeder
{

    public function __construct(public readonly UserRepository $userRepository)
    {

    }

    public function run(): void
    {
        $existedUser = $this->userRepository->getByEmail('admin@gmail.com');

        if ($existedUser === null) {

            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
                'active' => true,
            ]);


            DB::table('profiles')->insert([
                'first_name' => 'admin',
                'last_name' => 'admin',
                'user_id' => 1,
            ]);
        }
    }
}
