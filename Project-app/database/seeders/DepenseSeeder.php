<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\depense::factory(10)->create();

    }
}
