<?php

namespace Database\Factories;

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
        return [
            //
            'comment_desc'=>fake()->sentence(1),
            'comment_by'=>fake()->numberBetween(1,5),
            'comment_for'=>fake()->numberBetween(1,5),
            'created_at'=>fake()->date(),
            'updated_at'=>fake()->date()
            ];
    }
}
