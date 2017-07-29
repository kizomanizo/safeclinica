<?php

use Illuminate\Database\Seeder;

class Patient_transactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create fake transactions for patients using faker factory
        $patients = factory(App\Http\Models\Patient_transaction::class, 32)->create();
    }
}
