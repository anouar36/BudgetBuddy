<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => $this->faker->numberBetween(1, 20),
            'group_id' => $this->faker->numberBetween(1, 20),
            'depenses_id' => $this->faker->numberBetween(1, int2: 20),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'paid_by' => $this->faker->name(),
            'split_method' => $this->faker->randomElement(['equal', 'unequal']),
            
        ];
    }
}