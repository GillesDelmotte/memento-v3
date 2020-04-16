<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Job::create([
            'name' => 'Coiffeur'
        ]);
        App\Job::create([
            'name' => 'Ostéopathe'
        ]);
        App\Job::create([
            'name' => 'Esthéticienne'
        ]);
    }
}
