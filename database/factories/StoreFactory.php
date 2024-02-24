<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'category_id' => $this->faker->numberBetween(1, 10),
            'discription' => $this->faker->sentence,
            'open_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'close_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'price_range' => $this->faker->randomDigitNotNull,
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'holiday' => $this->faker->randomElement(['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', null]),
        ];
    }
}
