<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds to seed the Users table adding one user.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class, 5)->create();
    }
}