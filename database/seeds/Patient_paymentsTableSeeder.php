<?php

use Illuminate\Database\Seeder;

class Patient_paymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake payments for patients using faker factory
        $patients = factory(App\Http\Models\Patient_payment::class, 300)->create();
    }
}
