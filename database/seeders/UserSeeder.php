<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    private $tableName = 'users';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersSeeder = [
            [
                'id'                => '970c8462-41cd-4989-b5ea-3be9f17f62ce',
                'name'              => 'User 1',
                'username'          => 'user1',
                'email'             => 'user1@vielra.com',
                'photo_url'         => null,
                'avatar_text_color' => '#FF9F05',
                'password'          => Hash::make('password'),
                'status'            => 'active',
            ],
            [
                'id'                => '970c84ad-d91a-4707-8e44-9796cac739c',
                'name'              => 'User 2',
                'username'          => 'user2',
                'email'             => 'user2@vielra.com',
                'photo_url'         => null,
                'avatar_text_color' => '#3366FF',
                'password'          => Hash::make('password'),
                'status'            => 'active',
            ],
            [
                'id'                => '970c84ca-b258-46f9-a1c5-7095bc63ad00',
                'name'              => 'User 3',
                'username'          => 'user3',
                'photo_url'         => null,
                'email'             => 'user3@vielra.com',
                'avatar_text_color' => '#FF5C21',
                'password'          => Hash::make('password'),
                'status'            => 'active',
            ],
        ];


        // Run this seeder only local environment.
        if (App::environment('local')) {
            DB::table($this->tableName)->delete();
            DB::table($this->tableName)->insert($usersSeeder);
        }
    }
}
