<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UserSeeder.php
        User::create([
            'name' => 'Default User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'preferences' => [
                'primary_color' => '#0EA5A4',
                'dark_mode' => false,
                'language' => app()->getLocale(),
                'export' => ['csv', 'pdf'],
            ],
        ]);
    }
}
