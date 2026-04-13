<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@kmh.edu.np'],
            [
                'name' => 'KMH Administrator',
                'password' => Hash::make('admin123!'),
            ]
        );
        $admin->assignRole('admin');

        $editor = User::firstOrCreate(
            ['email' => 'editor@kmh.edu.np'],
            [
                'name' => 'KMH Editor',
                'password' => Hash::make('editor123!'),
            ]
        );
        $editor->assignRole('editor');
    }
}
