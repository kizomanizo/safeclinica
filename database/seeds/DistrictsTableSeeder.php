<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed this table from an SQL file
        DB::disableQueryLog();
        $path = 'database/seeds/sql/wilaya.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Districts table seeded!');
    }
}
