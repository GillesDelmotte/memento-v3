<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

            $checkEmail = User::where('email', $request['email'])->first();
            $user = Auth::user();
            if($checkEmail && $checkEmail->email !== $user->email){
                return $emailError = 'Cet email exist déja';
            }else{
                $user->email = $request['email'];
            }

            if($request['name'] != null){
                $user->name = $request['name'];
            }
            if($request['address'] != null){
                $user->address = $request['address'];
            }
            if($request['description'] != null){
                $user->description = $request['description'];
            }
            if($request['gsm'] != null){
                $user->gsm = $request['gsm'];
            }


        }
        $user->save();

    }

    public function updateTheme(Request $request, User $user)
    {
        $user = $user->where('id', auth()->id())->first();

        $user->theme = $request['color'];

        $user->save();
    }

    public function changePassword(Request $request){

        $user = User::where('email', $request['email'])->where('token', $request['token'])->first();

        if($request['newPassword'] !== $request['password_confirmation']){
            $error = 'vos mots de passe ne corresponde pas';
            return view('token', ['user' => $user, 'error' => $error]);
        }

        $user->password = Hash::make($request['newPassword']);
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect('/');

    }
}
