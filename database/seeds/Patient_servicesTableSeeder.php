<?php

use Illuminate\Database\Seeder;

class Patient_servicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake services for patients using faker factory
        $patients = factory(App\Http\Models\Patient_service::class, 10)->create();
    }
}
