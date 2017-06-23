<?php

/**
 * 데이터베이스 연결(MySql)
 * @param  array  $database ['host' => 'localhost', 'name' => 'root', 'user' => 'root', 'password' => '']
 * @return object
 */
function connection(array $database = [])
{
    if (is_array($database)) {
        try {
            return new \PDO(
                sprintf('mysql:host=%s;dbname=%s;port=%d;charset=%s', $database['host'], $database['name'], 3306, 'UTF8'),
                $database['user'],
                $database['password']
            );
        } catch (\PDOException $e) {
            die($e->getMessage() . '[' . $e->getCode() . ']');
        }
    } else {
        die('데이터베이스 설정 오류[9999]');
    }
}
