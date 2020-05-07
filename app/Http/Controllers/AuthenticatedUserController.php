<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function fetch(){
        $user = auth()->user();

        if($user->is_admin !== true){
            $user->load('job');
            $user->load('comments');
            $user->load('schedules');
        }

        return ['user' => $user];
    }
}
