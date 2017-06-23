<?php

namespace App\Controllers;

class JoinController extends Controller
{
    private $rules = [
        'name' => '이름::required|min:1',
        'email' => '이메일::required|email',
        'password' => '비밀번호::required|min:6|max:12|alpha_numeric',
        'password_confirmation' => '비밀번호 확인::required|match:password'
    ];

    public function signup()
    {
        return view('join/signup.php');
    }

    public function signupProcess()
    {
        $request = request('POST', [
            'name' => '', 'email' => '', 'password' => '', 'password_confirmation' => ''
        ], true);

        try {
            $validation = \Validation::make($request, $this->rules)->validate();
            if (! $validation['result']) {
                throw new \Exception($validation['messages'][0]);
            }
        } catch (\Exception $e) {
            return view('javascript/alertAfterTarget.php', [
                'message' => $e->getMessage(), 'target' => '/join/signup'
            ]);
        }
    }
}
