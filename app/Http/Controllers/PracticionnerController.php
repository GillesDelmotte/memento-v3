<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use App\Comment;

class PracticionnerController extends Controller
{
    public function index(User $user){
        $users = User::Where('schedule', '=', 1)->where('id', '<>', auth()->id())->orderBy('name', 'asc')->where('job_id', '<>', null)->get();
        $users = $users->load('job');
        $users = $users->load('comments');
        return $users;
    }

    public function getItem(User $user, Request $request){
        $schedules = Schedule::Where('user_id', $request->id)->get();
        return $schedules->load('days');
    }
}
