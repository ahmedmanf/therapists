<?php

use Illuminate\Database\Seeder;

class TherapistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Therapist::class, 50)->create();
    }
}
