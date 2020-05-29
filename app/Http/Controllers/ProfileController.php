<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request, User $user){
        $user = $user->where('id', auth()->id())->first();

        if($request['type'] === "check"){
            $column = $request['column'];
            $value = $request['value'];

            $user->$column = $value;
        }


        if($request['type'] === "all"){
            if($request['job'] != null){
                $job = Job::where("name",  '=',  $request['job'])->first();
                if($job){
                    $user->job_id = $job->id;
                }else{
                    $job = Job::create(['name' => $request['job']]);
                    $user->job_id = $job->id;
                }
            }
            $user->address = $request['address'];
            $user->description = $request['description'];
            $user->gsm = $request['gsm'];
            $user->email = $request['email'];
        }

        $user->save();

    }

    public function updateTheme(Request $request, User $user)
    {
        $user = $user->where('id', auth()->id())->first();

        $user->theme = $request['color'];

        $user->save();
    }
}
