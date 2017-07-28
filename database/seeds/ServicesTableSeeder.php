<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed known services
        DB::table('services')->insert([
        	'id' => 1,
            'name' => 'Laboratory',
            'cash' => 0,
            'insurance' => 0,
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);

        DB::table('services')->insert([
        	'id' => 2,
            'name' => 'Doctor',
            'cash' => 3000,
            'insurance' => 10000,
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);

        DB::table('services')->insert([
        	'id' => 3,
            'name' => 'Specialist',
            'cash' => 10000,
            'insurance' => 20000,
            'user' => 'Administrator',
            'created_at' => date('Y-m-d h:m:s'),
        ]);
    }
}
