<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('zh_TW');

        $users = \App\Models\User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'title' => $this->faker->sentence($nbWords = $this->faker->numberBetween(1, 6), $variableNbWords = true),
            'company' => $this->faker->company(),
            'email' => $this->faker->safeEmail,
            'description' => $this->faker->realText(100),
        ];
    }
}
