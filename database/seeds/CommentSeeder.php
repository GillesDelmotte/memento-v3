<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Comment::create([
            'user_id' => 1,
            'client_id' => 2,
            'comment' => 'Un commentaire qui explique comment gilles Delmotte n’est pas un bon kinésithérapeute et qu’il doit changer de profession.'
        ]);
        App\Comment::create([
            'user_id' => 1,
            'client_id' => 3,
            'comment' => 'Un commentaire qui explique comment gilles Delmotte n’est pas un bon kinésithérapeute et qu’il doit changer de profession.'
        ]);
    }
}
