<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'title'       => $this->faker->sentence(3),
        'content'     => $this->faker->paragraph,
        'user_id'     => \App\Models\User::factory(),       
        'category_id' => \App\Models\Category::factory(),    
        'is_active'   => $this->faker->randomElement(['Yes','No']),
    ];
}

}
