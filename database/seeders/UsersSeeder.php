<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@armyshop.xd',
            'password' => bcrypt('admin'),
            'license_picture' => null,
            'is_license_valid' => true,
            'address' => 'FIIT STU',
            'age' => 68,
            'telephone' => '+421900111222'
        ]);

        User::create([
            'id' => 2,
            'first_name' => 'Marosko',
            'last_name' => 'Bednar',
            'email' => 'marosko@armyshop.xd',
            'password' => bcrypt('marosko'),
            'license_picture' => null,
            'is_license_valid' => true,
            'address' => 'FIIT STU',
            'age' => 21
        ]);

        User::create([
            'id' => 3,
            'first_name' => 'Misko',
            'last_name' => 'Darovec',
            'email' => 'misko@armyshop.xd',
            'password' => bcrypt('misko'),
            'license_picture' => null,
            'is_license_valid' => true,
            'address' => 'FIIT STU',
            'age' => 21
        ]);

        User::create([
            'id' => 4,
            'first_name' => 'Bea',
            'last_name' => 'Belkova',
            'email' => 'bea@armyshop.xd',
            'password' => bcrypt('bea'),
            'license_picture' => null,
            'is_license_valid' => true,
            'address' => 'FIIT STU',
            'age' => 21
        ]);

        User::create([
            'id' => 5,
            'first_name' => 'Milada',
            'last_name' => 'Bednarova',
            'email' => 'milada@bednarova.sk',
            'password' => bcrypt('milada'),
            'license_picture' => null,
            'is_license_valid' => false,
        ]);

        User::create([
            'id' => 6,
            'first_name' => 'Vladimir',
            'last_name' => 'Bednar',
            'email' => 'vladimir@bednar.sk',
            'password' => bcrypt('vladimir'),
            'license_picture' => null,
            'is_license_valid' => false,
        ]);
    }
}