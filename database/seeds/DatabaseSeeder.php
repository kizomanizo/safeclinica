<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(TreatmentsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(InsurancesTableSeeder::class);
        $this->call(InvestigationsTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(Patient_insurancesTableSeeder::class);
        $this->call(Patient_investigationsTableSeeder::class);
        $this->call(Patient_paymentsTableSeeder::class);
        $this->call(Patient_servicesTableSeeder::class);
        $this->call(Patient_treatmentsTableSeeder::class);
        $this->call(Patient_transactionsTableSeeder::class);
    }
}
