<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function fetch(){
        $user = auth()->user();

        //$image = FilesUpload::where('user_id', auth()->id())->first();

        return ['user' => $user];
    }
}
