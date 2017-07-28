<?php

use Illuminate\Database\Seeder;

class Patient_insurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake insurances for patients using faker factory
        $patients = factory(App\Http\Models\Patient_insurance::class, 300)->create();
    }
}
