<?php

use App\Models\Session as TableSessions;

/**
 * 로그인 여부 확인
 * @return bool
 */
function isLogin()
{
    if (! array_key_exists('session', $GLOBALS)) {
        $session = TableSessions::instance()->info();
        if (is_array($session)) {
            return true;
        }
    } else {
        return true;
    }

    return false;
}

/**
 * 세션 조회
 * @param  string $key [Key]
 * @return string or array
 */
function session($key = '')
{
    if (isLogin()) {
        if (! array_key_exists('session', $GLOBALS)) {
            $GLOBALS['session'] = TableSessions::instance()->info();
        }

        if ($key !== '') {
            return $GLOBALS['session'][$key];
        }

        return $GLOBALS['session'];
    }

    return null;
}
