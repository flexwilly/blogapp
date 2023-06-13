<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'title'=>fake()->sentence(1),
            'description'=>fake()->sentence(15),
            'image'=>fake()->unique()->image(null, 640, 480),
            'created_at'=>fake()->date(),
            'updated_at'=>fake()->date(),
            'created_by'=>fake()->numberBetween(1,5)
        ];
    }
}
