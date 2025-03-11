<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        $follower = User::inRandomOrder()->first();
        $following_post = $follower->following->inRandomOrder()->first()->post;
        return [
            'id' => Str::id(),
            'user_id' => $follower->id,
            'post_id' => $following_post->id,
            'body' => $this->faker->paragraph(),
            'photo' => Str::toBase64(Str::random(40))
        ];
    }
}
