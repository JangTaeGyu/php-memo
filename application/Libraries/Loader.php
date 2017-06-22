<?php

namespace App\Libraries;

class Loader
{
    public static function __callStatic($method, array $args = [])
    {
        if (count($args) === 0) {
            return new \Exception('로드할 파일명을 입력해 주세요.');
        }

        $path = APPLICATION_PATH . '/' . ucfirst($method) . sprintf('/%s.php', $args[0]);
        if (is_file($path)) {
            return require $path;
        }

        return new \Exception('로드할 파일이 존재하지 않습니다.');
    }
}
