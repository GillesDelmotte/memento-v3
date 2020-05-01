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
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Simon Delmotte',
            'email' => 'simon.delmotte@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'gsm' => '0498 31 80 62',
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Véronique Dubois',
            'email' => 'veronique.dubois@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'gsm' => '0477 90 52 29',
            'password' => Hash::make('azerty'),
            'job_id' => 3,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Jean Charles',
            'email' => 'jean.charles@outlook.be',
            'address' => 'Rue de la bonne fortune 324, 4000 Liège',
            'gsm' => '0434 56 32 45',
            'password' => Hash::make('azerty'),
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Martin Collard',
            'email' => 'martin.Collard@outlook.be',
            'address' => 'Rue du paradis 456, 4030 grivegnée',
            'gsm' => '0449 50 38 28',
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Romain Messana',
            'email' => 'romain.messana@outlook.be',
            'address' => 'Rue de la campagne 34, 4020 Chênée',
            'gsm' => '0439 40 29 10',
            'password' => Hash::make('azerty'),
            'job_id' => 3,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Brice Myklos',
            'email' => 'brice.myklos@outlook.be',
            'address' => 'Rue de la belle canne 490, 4309 Ninane',
            'gsm' => '0429 48 10 30',
            'password' => Hash::make('azerty'),
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Charlotte Toussaint',
            'email' => 'charlotte.toussaint@outlook.be',
            'address' => 'Rue Fraischamps 154, 0987 luxembourg ville',
            'gsm' => '0477 90 52 29',
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
    }
}
