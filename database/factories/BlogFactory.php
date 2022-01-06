<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(10);
        $body = $this->faker->sentence(100);

        return [
            'title' => $title,
            'body' => $body,
            'slug' => str_slug($title, '-'),
            'meta_title' => str_limit($title,55),
            'meta_description' => str_limit($body,155),
        ];
    }
}
