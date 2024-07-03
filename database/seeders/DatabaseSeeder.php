<?php

namespace Database\Seeders;

use App\Models\Credit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // DB::table('credits')->truncate();
        // DB::table('users')->truncate();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => fake()->phoneNumber(),
            'password' => Hash::make(123),
            'is_admin' => true,
        ]);
        user::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => fake()->phoneNumber(),
            'password' => Hash::make(123),
            'is_admin' => false,
        ]);
        Credit::create([
            'user_id' => User::where('is_admin', false)->first()->id,
            'credits' => 10,
        ]);
    }
}
