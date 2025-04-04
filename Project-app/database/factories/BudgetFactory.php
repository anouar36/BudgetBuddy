<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->numberBetween(100, 1000),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
