<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Tage::factory(10)->create();
        \App\Models\depense::factory(10)->create();
        \App\Models\Group::factory()->count(10)->create(); 
        \App\Models\Budget::factory(10)->create();
        \App\Models\ExpensesGroup::factory(10)->create();

        
    }
}
