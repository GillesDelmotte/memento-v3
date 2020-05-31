<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TokenController extends Controller
{
    public function index($token){
        $user = User::where('token', $token)->first();

        return view('token', ['user' => $user, 'error' => null]);
    }
}
