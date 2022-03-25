<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->text(100),
            'text' => $this->faker->text(),
            'views' => $this->faker->randomNumber(1, false),
            'category_id' => $this->faker->numberBetween(1, 30),
            'author_id' => $this->faker->numberBetween(1, 80),
            'is_published' => $this->faker->numberBetween(1, 2),
            'image' => 'images/no_image.png	',
        ];
    }
}
