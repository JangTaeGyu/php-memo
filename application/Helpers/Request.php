<?php

/**
 * Request
 * @param  string  $method [GET Or POST]
 * @param  array   $data   [Params]
 * @param  bool    $flag   [Old Flag : true Or false]
 * @return array
 */
function request($method = 'GET', array $data = [], $flag = false)
{
    switch ($method) {
        case 'GET':
            $input = array_merge($_GET);
            break;
        case 'POST':
            $input = array_merge($_POST);
            break;
        default:
            $input = array_merge($_GET, $_POST);
            break;
    }

    if (count($data) > 0) {
        foreach ($data as $key => $value) {
            $request[$key] = array_key_exists($key, $input) && $input[$key] !== '' ? $input[$key] : $value;
        }
    } else {
        $request = $input;
    }

    // Request Session 저장하기
    if ($flag) {
        \Session::set('old', $request);
    }

    // Request Post 접근할때 무조건 토큰 추가
    if (! array_key_exists('_token', $request)) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (! array_key_exists('_token', $input)) {
                $request = array_merge(['_token' => ''], $request);
            } else {
                $request = array_merge(['_token' => $input['_token']], $request);
            }
        }
    }

    return $request;
}

/**
 * old 세션 조회
 * @param  string $name [Session Old Key]
 * @return string
 */
function old($name = '')
{
    if (\Session::exists('old')) {
        $session = \Session::get('old');

        if (array_key_exists($name, $session)) {
            return $session[$name];
        }
    }

    return '';
}
