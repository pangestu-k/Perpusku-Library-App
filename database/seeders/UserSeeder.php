<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Petugas Perpusku',
            'email' => 'perpus@petugas.com',
            'denda' => 0,
            'password' => Hash::make('password'),
            'role' => 'petugas'
        ]);
    }
}
