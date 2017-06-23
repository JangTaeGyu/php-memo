<?php

namespace App\Libraries;

class Hash
{
    const COST = 12;

    public static function make($string, $salt = '')
    {
        return password_hash($string, PASSWORD_DEFAULT, [
            'cost' => self::COST,
            'salt' => self::salt(32),
        ]);
    }

    public static function salt($length)
    {
        return utf8_encode(mcrypt_create_iv($length));
    }
}
