<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Gilles Delmotte',
            'email' => 'gilles.delmotte@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'gsm' => '0497 36 85 95',
            'password' => Hash::make('azerty'),
        ]);
    }
}
