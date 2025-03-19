<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $userId = $user->id;

        if ($user->followers->count() > 0) {
            $userId = $user->followers->first()->id;
        }

        return [
            'user_id' => $userId,
            'post_id' => $user->posts->random()->id,
            'body' => $this->faker->text(),
        ];
    }
}
