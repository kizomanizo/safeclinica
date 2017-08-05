<?php

use Illuminate\Database\Seeder;

class TreatmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed this table from an SQL file
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/treatments.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Treatments table seeded');

    }
}