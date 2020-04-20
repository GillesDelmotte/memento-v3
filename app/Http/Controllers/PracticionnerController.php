<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PracticionnerController extends Controller
{
    public function index(User $user){
        $user = User::Where('schedule', '=', 1)->where('id', '<>', auth()->id())->orderBy('name', 'asc')->where('job_id', '<>', null)->get();
        $user = $user->load('job');
        $user = $user->load('comments');
        return $user;
    }
}
