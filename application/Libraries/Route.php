<?php

namespace App\Libraries;

class Route
{
    public function __construct()
    {
        $GLOBALS['routes'] = [];
    }

    public function __call($method = '', array $args = [])
    {
        $method = strtoupper($method);

        list($url, $target) = $args;

        if (is_array($target)) {

            extract($target);

            list($controller, $call) = explode('@', $uses);
        } else {
            list($controller, $call) = explode('@', $target);
        }

        if (array_key_exists($method, $GLOBALS['routes'])) {
            if (array_key_exists($url, $GLOBALS['routes'][$method])) {
                throw new \Exception("{$method} Request Method 동일한 URI 정보가 정의 되어 있습니다.");
            }
        }

        $GLOBALS['routes'][$method][$url] = [
            'controller' => $controller, 'call' => $call, 'auth' => isset($auth) ? true : false
        ];
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        list($url) = explode('?', $_SERVER['REQUEST_URI']);

        if (array_key_exists($url, $GLOBALS['routes'][$method])) {

            // $controller, $call, $auth
            extract($GLOBALS['routes'][$method][$url]);

            if (class_exists('\\App\\Controllers\\' . $controller)) {

                $controller = '\\App\\Controllers\\' . $controller;
                $object = new $controller;

                if (method_exists($object, $call)) {
                    if ($auth) {

                        die;
                    }

                    echo call_user_func([$object, $call]);
                } else {
                    throw new \Exception("{$controller} 컨트롤러에 {$call} 메소드가 정의되지 않았습니다.");
                }
            } else {
                throw new \Exception("\\App\\Controllers\\{$controller} 컨트롤러가 정의되지 않았습니다.");
            }
        } else {
            throw new \Exception("URL 경로를 찾을 수 없습니다.");
        }
    }
}
