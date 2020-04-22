<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request, User $user){
        $user = $user->where('id', auth()->id())->first();

        $column = $request['column'];
        $value = $request['value'];


        if($column === 'job'){
            $job = Job::where("name",  '=',  $value)->first();
            if($job){
                $user->job_id = $job->id;
            }else{
                $job = Job::create(['name' => $value]);
                $user->job_id = $job->id;
            }
        }else{
            $user->$column = $value;
        }


        $user->save();

    }
}
