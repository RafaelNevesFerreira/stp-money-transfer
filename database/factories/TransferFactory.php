<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "cards_id" => $this->faker->unique(true)->numberBetween(1,10),
            "email" => $this->faker->unique(true)->safeEmail(),
            "value_sended" => $this->faker->numberBetween(25, 1000),
            "destinatary_name" => $this->faker->name(),
            "transfer_code" => uniqid(),
            "status" => $this->faker->randomElement(["sended","receveid","reimbursed"]),
            'address' => $this->faker->randomElement(["Abbéville-la-Rivière", "Angerville", "Angervilliers", "Arpajon", "Arrancourt", "Athis-Mons", "Authon-la-Plaine", "Auvernaux", "Auvers-Saint-Georges", "Avrainville", "Ballainvilliers", "Ballancourt-sur-Essonne", "Baulne", "Bièvres", "Blandy", "Boigneville", "Bois-Herpin", "Cerny", "Chalo-Saint-Mars", "Chalou-Moulineux", "Chamarande", "Champcueil", "Champlan", "Champmotteux", "Chatignonville", "Chauffour-lès-Étréchy", "Cheptainville", "Chevannes", "Chilly-Mazarin", "Corbeil-Essonnes", "Corbreuse", "Le Coudray-Montceaux", "Courances", "Courdimanche-sur-Essonne", "Courson-Monteloup", "Crosne", "Saint-Escobille", "Sainte-Geneviève-des-Bois", "Saint-Germain-lès-Arpajon", "Saint-Germain-lès-Corbeil", "Saint-Hilaire", "Saint-Jean-de-Beauregard", "Saint-Maurice-Montcouronne", "Saint-Michel-sur-Orge", "Saint-Pierre-du-Perray", "Saintry-sur-Seine", "Saint-Sulpice-de-Favières", "Saint-Vrain", "Saint-Yon", "Saulx-les-Chartreux", "Savigny-sur-Orge", "Sermaise",]),
            'country' => $this->faker->country(),
            "receveid_at" => $this->faker->date(),
            'phone_number' => $this->faker->phoneNumber(),

        ];
    }
}
