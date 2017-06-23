<?php

namespace App\Controllers;

class JoinController extends Controller
{
    public function signup()
    {
        return view('join/signup.php');
    }

    public function signupProcess()
    {
        $request = request('POST', [
            'name' => '', 'email' => '', 'password' => '', 'password_confirmation' => ''
        ], true);
    }
}
