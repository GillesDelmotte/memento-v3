<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PracticionnerController extends Controller
{
    public function index(User $user){
        $user = User::All();
        $user = $user->load('job');
        return $user;
    }
}
