<?php

namespace App\Libraries;

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
    public static function flash($key, $value)
    {
        if (self::exists($key)) {
            $session = self::get($key);
            self::delete($key);

            return $session;
        } else {
            self::put($key, $value);
        }
    }
}
