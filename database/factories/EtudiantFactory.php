<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prenom' => $this->faker->firstName(),
            'nom' => $this->faker->lastName(),
            'date_naissance' => $this->faker->date(),
            'lieu_naissance' => $this->faker->city(),
            'sexe' => $this->faker->randomElement(['masculin', 'feminin']),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->unique()->phoneNumber(),
            'situation_matrimoniale' => $this->faker->randomElement(['celibataire', 'marie', 'divorce', 'veuf']),
            'region_naissance' => $this->faker->city(),
            'adresse' => $this->faker->address(),
            'nationalite' => $this->faker->country(),
            'nom_complet_mere' => $this->faker->name(),
            'nom_complet_pere' => $this->faker->name(),
        ];
    }
}
