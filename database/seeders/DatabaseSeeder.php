<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['username' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')]);
        User::factory(5)->create();
        Post::factory(20)->create();
        Follow::factory(5)->create();
    }
}
