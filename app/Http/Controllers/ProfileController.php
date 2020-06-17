<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;
use App\Appointment;
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

            $checkEmail = User::where('email', $request['email'])->first();
            $user = Auth::user();
            if($checkEmail && $checkEmail->email !== $user->email){
                return $emailError = 'Cet email exist déja';
            }else{
                $user->email = $request['email'];
            }

            if($request['job'] != null){
                $job = Job::where("name",  '=',  $request['job'])->first();
                if($job){
                    $user->job_id = $job->id;
                }else{
                    $job = Job::create(['name' => $request['job']]);
                    $user->job_id = $job->id;
                }
            }


            if($request['name'] != null){
                $user->name = $request['name'];
            }
            if($request['address'] != null){
                $user->address = $request['address'];
            }
            if($request['postal'] != null){
                $user->postalCode = $request['postal'];
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
        $user->token = NULL;
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect('/');

    }

    public function deleteProfil($token)
    {
        $user = User::where('token', $token)->first();
        if($user){
            $appointments = Appointment::where('user_id', $user->id)->get();

            foreach($appointments as $appointment){
                $appointment->user_id = NULL;
                $appointment->name = $user->name;
                $appointment->save();
            }

            $user->delete();

        }

        return view('deleted', ['user' => $user]);
    }
}
