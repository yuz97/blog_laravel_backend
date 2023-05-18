<?php

namespace Database\Factories\Posts;

use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => rand(1, 3),
            'subject_id' => rand(1, 3),
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence() . Str::random(4)),
            'body' => $this->faker->paragraph(15),
        ];
    }
}
