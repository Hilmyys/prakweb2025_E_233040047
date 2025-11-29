<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        
        return [
            'user_id' => \App\Models\User::factory(),
            'category' => \App\Models\category::factory(),
            'title' => $title,
            'slug' => Str::slug('$title'),
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'image' => null

        ];
    }
}
