<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    private $request = [
        'email' => '', 'password' => ''
    ];

    private $rules = [
        'email' => '이메일::required|email',
        'password' => '비밀번호::required|min:6|max:12|alpha_numeric'
    ];

    public function login()
    {
        return view('auth/login.php');
    }

    public function loginProcess()
    {
        $request = request('POST', $this->request, true);

        try {
            $validation = \Validation::make($request, $this->rules)->validate();
            if (! $validation['result']) {
                throw new \Exception($validation['messages'][0]);
            }

            $user = User::find(['email' => $request['email']]);
            if (is_array($user)) {
                if (password_verify($request['password'], $user['password'])) {
                    \Session::save($user['id']);
                } else {
                    throw new \Exception("비밀번호가 일치하지 않습니다. 다시 확인해 주세요.");
                }
            } else {
                throw new \Exception("일치하는 회원이 없습니다. 다시 확인해 주세요.");
            }

        } catch (\Exception $e) {
            return view('javascript/alertAfterTarget.php', [
                'message' => $e->getMessage(),
                'target' => '/auth/login'
            ]);
        }

        \Session::flash('success', '로그인에 성공하셨습니다');

        \Session::delete('old');

        redirect(APP_URL);
    }

    public function logout()
    {
        \Session::checkout();

        redirect(APP_URL);
    }
}
