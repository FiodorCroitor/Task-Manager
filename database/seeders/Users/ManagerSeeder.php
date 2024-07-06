<?php

namespace Database\Seeders\users;

use App\Models\User;
use App\Repository\User\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use voku\helper\ASCII;

final class ManagerSeeder extends Seeder
{

    public function __construct(public readonly UserRepository $userRepository)
    {

    }

    public function run(): void
    {
        $existedUser = $this->userRepository->getByEmail('manager@gmail.com');

        if ($existedUser === null) {
            DB::table('users')->insert([
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('root'),
                'email_verified_at' => now(),
                'active' => true,
            ]);


            DB::table('profiles')->insert([
                'first_name' => 'manager',
                'last_name' => 'manager',
                'user_id' => 2,
            ]);


        }
    }
}
