<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Role;
use App\Http\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds to seed the Users table adding one user.
     *
     * @return void
     */
    public function run()
    {
        // $user = factory(App\Http\Models\User::class, 3)->create();
        $role_administrator = Role::where('name', 'administrator')->first();
	    $role_registration  = Role::where('name', 'registration')->first();
	    $role_doctor = Role::where('name', 'doctor')->first();
	    $role_laboratory  = Role::where('name', 'laboratory')->first();
	    $role_manager = Role::where('name', 'manager')->first();

	    $employee = new User();
	    $employee->name = 'Peter Marusu';
	    $employee->username = 'peter';
	    $employee->password = bcrypt('petermarusu');
	    $employee->save();
	    $employee->roles()->attach($role_administrator);

	    $manager = new User();
	    $manager->name = 'Olympia Massawe';
	    $manager->username = 'olympia';
	    $manager->password = bcrypt('olympia');
	    $manager->save();
	    $manager->roles()->attach($role_registration);

	    $manager = new User();
	    $manager->name = 'Dr.Patrick';
	    $manager->username = 'patrick';
	    $manager->password = bcrypt('drpatrick');
	    $manager->save();
	    $manager->roles()->attach($role_doctor);

	    $manager = new User();
	    $manager->name = 'Lab Tech';
	    $manager->username = 'lab';
	    $manager->password = bcrypt('labtech');
	    $manager->save();
	    $manager->roles()->attach($role_laboratory);

	    $manager = new User();
	    $manager->name = 'Editha Paul';
	    $manager->username = 'editha';
	    $manager->password = bcrypt('edithapaul');
	    $manager->save();
	    $manager->roles()->attach($role_manager);

	    $employee = new User();
	    $employee->name = 'Bw. Kizito';
	    $employee->username = 'kizito';
	    $employee->password = bcrypt('bwanakizito');
	    $employee->save();
	    $employee->roles()->attach($role_administrator);
    }
}