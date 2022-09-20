<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Constants\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = [
            'uuid' => Str::uuid(),
            'username' => 'malayvuong',
            'name' => 'iSPA CMS',
            'email' => 'team@ispa.io',
            'password' => bcrypt('ispa.io'),
            'email_verified_at' => now(),
            'type' => UserType::WEBMASTER,
            'level' => 0,
        ];

        $user = User::create($user);

        //  Todo: Set role later
    }
}
