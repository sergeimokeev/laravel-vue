<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'title' => Str::ucfirst($this->faker->unique()->words(3, true)),
            'slug' => $this->faker->unique()->slug(3),
            'preview' => $this->faker->paragraph(1),
            'body' => $this->faker->text(1000),
            'is_published' => true
        ];
    }
}
