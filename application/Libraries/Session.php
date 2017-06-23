<?php

namespace App\Libraries;

use App\Models\Session as TableSessions;

class Session
{
    /**
     * 세션 키 존재여부 확인
     * @param  string $name [Key Name]
     * @return bool
     */
    public static function exists($name)
    {
        return array_key_exists($name, $_SESSION);
    }

    /**
     * 세션 저장
     * @param  string $name  [Key]
     * @param  string $value [Value]
     * @return bool
     */
    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    /**
     * 세션 조회
     * @param  string $name [Key]
     * @return string
     */
    public static function get($name)
    {
        return self::exists($name) ? $_SESSION[$name] : '';
    }

    /**
     * 세션 삭제
     * @param  string $name [Key]
     * @return void
     */
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * 세션 존재여부 판단 후 삭제 또는 저장
     * @param  string $key   [Key]
     * @param  string $value [Value]
     * @return string
     */
    public static function flash($key, $value = '')
    {
        if (self::exists($key)) {
            $session = self::get($key);
            self::delete($key);

            return $session;
        } else {
            self::set($key, $value);
        }
    }

    /**
     * 세션 저장
     * @param  integer $id [users::id]
     * @return boolean
     */
    public static function save($id = 0)
    {
        return TableSessions::insert([
            'session_id' => session_id(),
            'session_expires' => time() + (int) get_cfg_var('session.gc_maxlifetime'),
            'user_id' => $id,
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'date' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 세션 삭제
     * @return bool
     */
    public static function checkout()
    {
        return TableSessions::delete(session_id());
    }

    /**
     * 세션 중복
     * @return bool
     */
    public static function overlap()
    {
        if (! is_null(session('id'))) {
            $count = TableSessions::count(['user_id' => session('id'), '>|session_expires' => time()]);
            if ((int) $count > 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * 세션 만료
     * @return bool
     */
    public static function expiration()
    {
        if (! is_null(session('id'))) {
            $params = ['user_id' => session('id'), '<|session_expires' => time()];

            $count = TableSessions::count($params);
            if ((int) $count > 0) {
                return TableSessions::delete($params);
            }
        }

        return false;
    }
}
