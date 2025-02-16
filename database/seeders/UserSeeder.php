<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'coba1',
            'email' => 'coba1@gmail.com',
            'password' => bcrypt('coba1')
        ]);

        $user2 = User::create([
            'name' => 'coba2',
            'email' => 'coba2@gmail.com',
            'password' => bcrypt('coba2')
        ]);

        $user3 = User::create([
            'name' => 'coba3',
            'email' => 'coba3@gmail.com',
            'password' => bcrypt('coba3')
        ]);

        $user4 = User::create([
            'name' => 'coba4',
            'email' => 'coba4@gmail.com',
            'password' => bcrypt('coba4')
        ]);


        $user1->assignRole('User');
        $user2->assignRole('User');
        $user3->assignRole('User');
        $user4->assignRole('User');
       
    }
}
