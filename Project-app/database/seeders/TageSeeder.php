<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tage::factory(10)->create();
    }
}
