<?php

namespace App\Controllers;

use App\Models\User;

class JoinController extends Controller
{
    private $request = [
        'name' => '', 'email' => '', 'password' => '', 'password_confirmation' => ''
    ];

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
        $request = request('POST', $this->request, true);

        try {
            $validation = \Validation::make($request, $this->rules)->validate();
            if (! $validation['result']) {
                throw new \Exception($validation['messages'][0]);
            }

            // 회원 중복 체크
            $count = User::count(['email' => $request['email']]);
            if ((int) $count > 0) {
                throw new \Exception("중복되는 이메일이 있습니다. 다시 확인해 주세요.");

            }

            // Hash Key 생성
            $salt = \Hash::salt(32);

            // 회원 저장
            $result = User::insert([
                'name' => $request['name'], 'email' => $request['email'], 'password' => \Hash::make($request['password'], $salt), 'created_at' => date('Y-m-d H:i:s')
            ]);
            if ((int) $result === 0) {
                throw new Exception("회원가입에 실패하였습니다. 다시 시도해 주세요.");
            }

        } catch (\Exception $e) {
            return view('javascript/alertAfterTarget.php', [
                'message' => $e->getMessage(),
                'target' => '/join/signup'
            ]);
        }

        redirect(APP_URL);
    }
}
