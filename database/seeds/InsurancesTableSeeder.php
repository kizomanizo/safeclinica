<?php

use Illuminate\Database\Seeder;

class InsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed known insurances
        DB::table('insurances')->insert([
        	'id' => 1,
            'name' => 'Cash',
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);

        DB::table('insurances')->insert([
        	'id' => 2,
            'name' => 'Strategis',
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);

        DB::table('insurances')->insert([
        	'id' => 3,
            'name' => 'NHIF',
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);
    }
}
