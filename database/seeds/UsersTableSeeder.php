<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds to seed the Users table adding one user.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Safe Focus',
            'username' => 'safefocus',
            'password' => bcrypt('safefocus'),
        ]);
    }
}