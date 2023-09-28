<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = array(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('123456'),
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);

        Role::updateOrCreate(
            [
                'name' => 'admin',
            ],
            ['name' => 'admin']
        );

        Role::updateOrCreate(
            [
                'name' => 'kasir',
            ],
            ['name' => 'kasir']
        );

        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('kasir');

    }
}
