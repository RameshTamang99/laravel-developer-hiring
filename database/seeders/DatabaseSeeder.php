<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=> Hash::make('admin@admin.com'),
            'is_super_admin'=>1,
            'status'=>1
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password'=> Hash::make('user@user.com'),
            'is_super_admin'=>0,
            'status'=>1
        ]);
    }
}
