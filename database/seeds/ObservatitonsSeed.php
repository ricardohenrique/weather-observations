<?php

use Illuminate\Database\Seeder;

class ObservatitonsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ObservationModel::class, 10)->create();
    }
}
