<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Kollawach',
                'username' => 'kollawach',
                'password' => bcrypt('password'),
                'role' => 'Admin',
            ],
            [
                'name' => 'Chat',
                'username' => 'chat',
                'password' => bcrypt('password'),
                'role' => 'Employee',
            ],
            [
                'name' => 'Kon',
                'username' => 'Kon',
                'password' => bcrypt('password'),
                'role' => 'Customer',
                'id_card' => '1234567891011',
                // 'birth_date' => '2000-11-16',
                'tel' => '1234567890',
                'address' => 'bangkok test'
            ],
        ];
        // \App\Models\User::factory(10)->create();
        foreach($users as $user){
            User::create($user);
        }
    }
}
