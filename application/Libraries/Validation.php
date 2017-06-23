<?php

namespace App\Libraries;

use App\Libraries\Rules\RuleTrait as Rule;
use App\Libraries\Rules\TokenCheckTrait as TokenCheck;

class Validation
{
    use Rule, TokenCheck;

    private $messages = [];

    private $error = [];

    public static function make(array $request = [], array $rules = [])
    {
        $instance = new self;

        if (count($rules) === 0) {
            array_push($instance->messages, '데이터검증 룰 정보가 없습니다.');
        } else {

            // Request Method POST 이면 무조건 토큰 체크 하도록 처리
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rules = array_merge(['_token' => '토큰::required|base64|token_check'], $rules);
            }

            foreach ($rules as $key => $rule) {
                if (! array_key_exists($key, $request)) {
                    array_push($instance->messages, '요청정보에 검증할 데이터 정보가 없습니다.');
                    break;
                }

                list($title, $methods) = explode('::', $rule);

                foreach (explode('|', $methods) as $method) {
                    if (strpos($method, ':') === false) {
                        $result = call_user_func_array([$instance, $method], [$request[$key]]);
                    } else {
                        list($method, $attribute) = explode(':', $method);
                        $result = call_user_func_array([$instance, $method], [$request[$key], $attribute]);
                    }

                    if (! $result) {
                        $instance->error($title, $key, $method, isset($attribute) ? $attribute : '');
                        break;
                    }
                }
            }
        }

        return $instance;
    }

    private function error($title, $key, $method, $attribute = '')
    {
        $messages = \Loader::languages('ko/rules');

        array_push($this->messages, sprintf($messages[$method], $title, $attribute));

        $this->error = array_merge($this->error, [$key => sprintf($messages[$method], $title, $attribute)]);
    }

    public function validate()
    {
        return [
            'result' => count($this->messages) === 0 ? true : false,
            'messages' => $this->messages,
            'error' => $this->error,
        ];
    }
}
