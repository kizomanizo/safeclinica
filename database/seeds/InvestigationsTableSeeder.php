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
        $investigations = factory(App\Http\Models\Investigation::class, 15)->create();
    }
}
