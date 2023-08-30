<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user with a specific role
        $user = User::create([
            'name' => 'Passenger Name',
            'email' => 'passenger@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'passenger', // Adjust the value based on your schema
        ]);

        // Assign the "passenger" role to the user
        $user->assignRole('passenger');

        // Create an admin user with the admin role
        $adminUser = User::create([
            'name' => 'Admin Name',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin', // Adjust the value based on your schema
        ]);

        // Assign the "admin" role to the admin user
        $adminUser->assignRole('admin');
    }
}
