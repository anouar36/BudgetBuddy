<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numberBetween(1, 10),
        ];
    }
    
    
}
