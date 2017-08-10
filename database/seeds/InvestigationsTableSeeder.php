<?php

use Illuminate\Database\Seeder;

class InvestigationsTableSeeder extends Seeder
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
        $path = asset('sql/investigations.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Treatments table seeded');

    }
}
