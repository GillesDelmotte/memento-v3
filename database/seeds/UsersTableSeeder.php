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
            'name' => 'admin',
            'email' => 'admin@admin.be',
            'password' => Hash::make('azerty'),
            'is_admin' => 1
        ]);
        App\User::create([
            'name' => 'Gilles Delmotte',
            'email' => 'gilles.delmotte@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'postalCode' => 4030,
            'password' => Hash::make('azerty'),
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Simon Delmotte',
            'email' => 'simon.delmotte@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'postalCode' => 4030,
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Véronique Dubois',
            'email' => 'veronique.dubois@outlook.be',
            'address' => 'Rue Fraischamps 154, 4030 grivegnée',
            'postalCode' => 4030,
            'password' => Hash::make('azerty'),
            'job_id' => 3,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Jean Charles',
            'email' => 'jean.charles@outlook.be',
            'address' => 'Rue de la bonne fortune 324, 4000 Liège',
            'postalCode' => 4000,
            'password' => Hash::make('azerty'),
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Martin Collard',
            'email' => 'martin.Collard@outlook.be',
            'address' => 'Rue du paradis 456, 4000 grivegnée',
            'postalCode' => 4000,
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Romain Messana',
            'email' => 'romain.messana@outlook.be',
            'address' => 'Rue de la campagne 34, 4020 Chênée',
            'postalCode' => 4020,
            'password' => Hash::make('azerty'),
            'job_id' => 3,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Brice Miklos',
            'email' => 'brice.myklos@outlook.be',
            'address' => 'Rue de la belle canne 490, 4309 Ninane',
            'postalCode' => 4039,
            'password' => Hash::make('azerty'),
            'job_id' => 1,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Charlotte Toussaint',
            'email' => 'charlotte.toussaint@outlook.be',
            'address' => 'Rue de Potier 3, 3000 luxembourg ville',
            'postalCode' => 3000,
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Pierre Dupond',
            'email' => 'pierre.dupond@outlook.be',
            'address' => 'Rue de la forge 18, 3000 luxembourg ville',
            'postalCode' => 3000,
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);
        App\User::create([
            'name' => 'Rosi Piazza',
            'email' => 'rosi.piazza@outlook.be',
            'address' => 'Rue des francais 18, 4730 Ans',
            'postalCode' => 4730,
            'password' => Hash::make('azerty'),
            'job_id' => 2,
            'schedule' => 1
        ]);

    }
}
