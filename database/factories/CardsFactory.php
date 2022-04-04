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
            "card_number" => $this->faker->creditCardNumber(),
            "card_expiration_month" => $this->faker->creditCardExpirationDate(),
            "card_expiration_year" => $this->faker->creditCardExpirationDate(),
        ];
    }
}
