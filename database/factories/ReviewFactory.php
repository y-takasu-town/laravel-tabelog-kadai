<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->text,
            'user_id' => User::factory(),
            'store_id' => Store::factory(),
            'star' => $this->faker->numberBetween(1, 5),
        ];
    }
}
