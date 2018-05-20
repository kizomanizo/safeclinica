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
	    $employee->name = 'Admin Strator';
	    $employee->username = 'admin';
	    $employee->password = bcrypt('admin');
	    $employee->save();
	    $employee->roles()->attach($role_administrator);

	    $manager = new User();
	    $manager->name = 'Regis Tration';
	    $manager->username = 'registration';
	    $manager->password = bcrypt('registration');
	    $manager->save();
	    $manager->roles()->attach($role_registration);

	    $manager = new User();
	    $manager->name = 'Doctor Who';
	    $manager->username = 'doctor';
	    $manager->password = bcrypt('doctor');
	    $manager->save();
	    $manager->roles()->attach($role_doctor);

	    $manager = new User();
	    $manager->name = 'Laboratory Technician';
	    $manager->username = 'laboratory';
	    $manager->password = bcrypt('laboratory');
	    $manager->save();
	    $manager->roles()->attach($role_laboratory);

	    $manager = new User();
	    $manager->name = 'Manager Facility';
	    $manager->username = 'manager';
	    $manager->password = bcrypt('manager');
	    $manager->save();
	    $manager->roles()->attach($role_manager);

	    $employee = new User();
	    $employee->name = 'User Facility';
	    $employee->username = 'user';
	    $employee->password = bcrypt('user');
	    $employee->save();
	    $employee->roles()->attach($role_administrator);
    }
}
