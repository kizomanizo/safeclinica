<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake patients using faker factory
        $patients = factory(App\Http\Models\Patient::class, 300)->create();
    }
}
