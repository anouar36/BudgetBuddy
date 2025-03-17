<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;
use App\Models\User;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, 
            'devise' => $this->faker->currencyCode, 
            'user_id' => User::factory()->numberBetween(1, 10), 
        ];
    }
}
