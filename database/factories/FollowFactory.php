<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
{
    public function definition(): array
    {
        do {
            $follower = User::inRandomOrder()->first();
            $following = User::inRandomOrder()->first();

            $exists = \DB::table('follows')
                ->where('follower_id', $follower->id)
                ->where('following_id', $following->id)
                ->exists();
        } while ($follower->id === $following->id || $exists);

        return [
            'follower_id' => $follower->id,
            'following_id' => $following->id,
        ];
    }
}
