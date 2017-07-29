<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
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

        // $this->call('RegionsTableSeeder');
        // $this->command->info('User table seeded!');

        DB::disableQueryLog();
        $path = 'database/seeds/sql/pwani.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Regions table seeded!');
    }
}
