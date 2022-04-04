<?php

namespace Database\Factories;

use App\Models\Cards;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cards>
 */
class CardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "card_number" => $this->faker->randomElement([4242424242424242,4000056655665556,5555555555554444,4000002500003155,371449635398431,4000002760003184,4000008260003178]),
            "card_expiration_month" => $this->faker->numberBetween(1 , 12),
            "card_expiration_year" => $this->faker->numberBetween(2022, 2050),
            "users_id" => $this->faker->numberBetween(1, 1),
        ];
    }
}
