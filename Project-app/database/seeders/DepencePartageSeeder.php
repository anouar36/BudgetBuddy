<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepencePartageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DepencePartage::factory(10)->create();
    }
}
