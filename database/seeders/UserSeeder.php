<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
            ],
        )->assignRole('admin')->givePermissionTo('view dashboard', 'view users', 'view roles', 'view permissions', 'view activities', 'view activity', 'create user', 'edit user', 'delete user', 'create role', 'edit role', 'delete role', 'create permission', 'edit permission', 'delete permission');

        User::factory()->create(
            [
                'name' => 'User',
                'email' => 'user@email.com',
            ],
        )->assignRole('user')->givePermissionTo('view dashboard', 'view users', 'view activities', 'view activity', 'view roles', 'view permissions');
    }
}
