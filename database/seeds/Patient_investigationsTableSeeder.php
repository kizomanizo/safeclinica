<?php

use Illuminate\Database\Seeder;

class Patient_investigationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake investigations for patients using faker factory
        $patients = factory(App\Http\Models\Patient_investigation::class, 300)->create();
    }
}
