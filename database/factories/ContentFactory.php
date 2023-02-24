<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'thumbnail_url' => $this->faker->url(),
            'rating' => $this->faker->numberBetween(1, 5),
            'trailer_url' => $this->faker->url(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'category_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
