<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admins; 

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admins::create([
            'name' => 'Admin Party Scale',
            'email' => 'admin@partyscale.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
