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
            'description' => 'Une description qui est plutôt longue car il faut du texte pour voir ce que cela donne. Gilles Delmotte n’est pas du tout Kinésithérapeute, il ne sait rien faire la dedans, c’est un escrot',
            'gsm' => '0497 36 85 95',
            'password' => Hash::make('azerty'),
        ]);
        App\User::create([
            'name' => 'Simon Delmotte',
            'email' => 'simon.delmotte@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'gsm' => '0498 31 80 62',
            'password' => Hash::make('azerty'),
        ]);
        App\User::create([
            'name' => 'Véronique Dubois',
            'email' => 'vernonique.dubois@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'gsm' => '0477 90 52 29',
            'password' => Hash::make('azerty'),
        ]);
    }
}
