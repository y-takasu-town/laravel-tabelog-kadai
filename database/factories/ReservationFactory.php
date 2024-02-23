<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reserved_time' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'amount' => $this->faker->numberBetween(1, 10),
            'user_id' => User::factory(),
            'store_id' => Store::factory(),
        ];
    }
}
