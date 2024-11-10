<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            //
            'user_id' => User::all()->random()->id,
            'title' => $title = $this->faker->sentence(),
            'slug'  => Str::slug($title),
            'body'  => $this->faker->text(2200)
        ];
    }
}
