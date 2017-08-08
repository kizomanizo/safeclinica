<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed the roles table
        $role_administrator = new App\Http\Models\Role();
	    $role_administrator->name = 'administrator';
	    $role_administrator->description = 'System Administrator';
	    $role_administrator->save();

	    $role_registration = new App\Http\Models\Role();
	    $role_registration->name = 'registration';
	    $role_registration->description = 'The user who registers patients';
	    $role_registration->save();

	    $role_doctor = new App\Http\Models\Role();
	    $role_doctor->name = 'doctor';
	    $role_doctor->description = 'A Doctor for doctors module';
	    $role_doctor->save();

	    $role_laboratory = new App\Http\Models\Role();
	    $role_laboratory->name = 'laboratory';
	    $role_laboratory->description = 'Laboratory user';
	    $role_laboratory->save();

	    $role_manager = new App\Http\Models\Role();
	    $role_manager->name = 'manager';
	    $role_manager->description = 'Clinic management for reports';
	    $role_manager->save();
    }
}
