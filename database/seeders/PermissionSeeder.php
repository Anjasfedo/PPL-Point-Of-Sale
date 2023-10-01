<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;
use App\Models\Penjualan;
use App\Models\Pembelian;

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

        $penjualan = new Penjualan;
        $penjualan->total_item = 0;
        $penjualan->total_penjualan = 0;
        $penjualan->diterima = 0;
        $penjualan->kembalian = 0;
        $penjualan->save();

        $pembelian = new Pembelian;
        $pembelian->total_item = 0;
        $pembelian->total_pembelian = 0;
        $pembelian->diterima = 0;
        $pembelian->kembalian = 0;

        $pembelian->save();


    }
}
