<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $following = User::inRandomOrder()->first();
            $follower = User::inRandomOrder()->first();
        } while (
            $follower->id === $following->id ||
            $follower->isFollowing($following)
        );

        return [
            'following_id' => $following->id,
            'follower_id' => $follower->id,
        ];
    }
}
