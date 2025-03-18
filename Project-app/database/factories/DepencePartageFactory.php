<?php
namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DepencePartage;
use App\Models\Group;

class DepencePartageFactory extends Factory
{
    protected $model = DepencePartage::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, 
            'montant' => $this->faker->randomFloat(2, 5, 500), // Random amount between 5 and 500
            'group_id' => $this->faker->numberBetween(1, 10), 
            'description' => $this->faker->sentence,
        ];
    }
}
