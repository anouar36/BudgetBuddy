<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Depense;
use App\Models\DepencePartage;
use App\Models\Tage;

class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'category_id' => $this->faker->numberBetween(1, 10), 
            'date' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(1, 10),

        ];
        
    }

    public function configure()
    {
        return $this->afterCreating(function (Depense $depense) {

            if (Tage::count() > 0) {
                
                $depense_id = rand(1, 10);
        
                $tags = Tage::inRandomOrder()->limit(rand(1, 10))->pluck('id');
        
                \DB::table('depense_tage')->insert([
                    'depense_id' => $depense_id,
                    'tage_id' => $tags->random(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

}
