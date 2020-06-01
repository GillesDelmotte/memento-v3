<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\ForgotPasswordMail;

use App\User;

class TokenController extends Controller
{
    public function index($token){
        $user = User::where('token', $token)->first();
        $errors = [];

        return view('token', ['user' => $user, 'error' => null]);
    }

    public function create(Request $request){
        $token = $request['token'];
        $email = $request['email'];

        if($token === NULL){
            $user = User::where('email', $email)->first();

            if($user){
                $newToken = Str::random(32);
                $user->token = $newToken;
                $user->save();

                Mail::to($user->email)->send(new ForgotPasswordMail($user));

                return view('forgot', ['userEmail' => $user->email, 'lastEmail' => null, 'success' => true, 'emailError' => ''] );
            }else{
                return view('forgot', ['userEmail' => null, 'lastEmail' => $email, 'success' => false, 'emailError' => 'Ces identifiants ne correspondent pas à nos enregistrements']);
            }
        }else{
            $user = User::where('email', $email)->where('token', $token)->first();
            if($user){
                return redirect('/verifyToken/' . $token);
            }else{
                return view('forgot', ['userEmail' => null, 'lastEmail' => $email, 'success' => false, 'emailError' => 'Il n‘y a pas de correspondance entre votre email et votre token'] );

            }
        }
    }
}
