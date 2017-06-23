<?php

namespace App\Models;

use App\Models\Traits\CrudTrait;

class Model
{
    use CrudTrait;

    protected $db = null;

    private $prefix = 'scope';

    public function __construct()
    {
        $database = \Loader::configs('database');

        $this->db = connection($database['localhost']);
    }

    public static function __callStatic($method, $parameters)
    {
        $instance = new static;

        $call = $instance->prefix . ucfirst($method);
        if (method_exists($instance, $call)) {
            return call_user_func_array([$instance, $call], $parameters);
        }

        return new \Exception("{$call} 메서드가 확인되지 않습니다.");
    }
}
