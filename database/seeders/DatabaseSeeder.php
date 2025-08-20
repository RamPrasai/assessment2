<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'type'     => 'admin',
                'password' => bcrypt('password'),
            ]
        );

        
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'     => 'User',
                'type'     => 'user',
                'password' => bcrypt('password'),
            ]
        );

        
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
