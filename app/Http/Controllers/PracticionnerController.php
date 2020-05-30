<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use App\Comment;
use App\Appointment;

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
        $schedules->load('days');
        $schedules->load('appointments');
        return $schedules;
    }

    public function getPractitionner(Request $request){
        $user = User::where('id', $request['id'])->first();

        $user->load('job');
        $user->load('comments');

        return $user;
    }

    public function getClients(){

        $user = User::where('id', Auth()->id())->first();
        $user->load('schedules');

        $clients_id = [];

        $clients = [];

        foreach($user->schedules as $schedule){
            $clientsAppointment = Appointment::where('schedule_id', $schedule['id'])->where('user_id', '<>', NULL)->distinct()->get('user_id');

            foreach($clientsAppointment as $client){
                $clients_id[] = $client->user_id;
            }
        }

        $unique = array_unique($clients_id);

        foreach($unique as $id){
            $user = User::where('id', $id)->first();
            $clients[] = $user;
        }

        return $clients;

    }

    public function findPersons(Request $request){

        $users = User::where('name', 'LIKE',  '%' . $request['name'] . '%')->where('id', '<>', '1')->orderBy('name', 'asc')->get();
        return $users;
    }
}
