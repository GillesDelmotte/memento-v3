<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function fetch(){
        $user = auth()->user();

        $user->load('job');
        $user->load('comments');

        //$image = FilesUpload::where('user_id', auth()->id())->first();

        return ['user' => $user];
    }
}
