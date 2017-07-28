<?php

use Illuminate\Database\Seeder;

class Patient_treatmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake treatments for patients using faker factory
        $patients = factory(App\Http\Models\Patient_treatment::class, 300)->create();
    }
}
