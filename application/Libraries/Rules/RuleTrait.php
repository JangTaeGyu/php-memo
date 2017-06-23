<?php

namespace App\Libraries\Rules;

trait RuleTrait
{
    private function required($value)
    {
        return is_array($value) ? (boolean) count($value) : (trim($value) !== '');
    }

    private function in($value, $list)
    {
        return in_array($value, explode(',', $list), true);
    }

    private function integer($value)
    {
        if (is_array($value)) {
            foreach ($value as $string) {
                $result = (boolean) preg_match('/^[\-+]?[0-9]+$/', $string);
                if (! $result) {
                    return false;
                }
            }
            return true;
        } else {
            return (boolean) preg_match('/^[\-+]?[0-9]+$/', $value);
        }
    }

    private function numeric($value)
    {
        if (is_array($value)) {
            foreach ($value as $string) {
                $result = (boolean) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $string);
                if (! $result) {
                    return false;
                }
            }
            return true;
        } else {
            return (boolean) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value);
        }
    }

    private function min($value, $length = 0)
    {
        if (preg_match('/[^0-9]/', $length)) {
            return false;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($value, 'UTF-8') < $length) ? false : true;
        }

        return (strlen($value) < $length) ? false : true;
    }

    private function max($value, $length = 0)
    {
        if (preg_match('/[^0-9]/', $length)) {
            return false;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($value, 'UTF-8') > $length) ? false : true;
        }

        return (strlen($value) > $length) ? false : true;
    }

    private function size($value, $length = 0)
    {
        if (preg_match('/[^0-9]/', $length)) {
            return false;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($value, 'UTF-8') == $length) ? true : false;
        }

        return (strlen($value) == $length) ? true : false;
    }

    private function email($value)
    {
        return (! preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value)) ? false : true;
    }

    private function alpha($value)
    {
        if (function_exists('ctype_alnum')) {
            return ctype_alpha($value);
        }
        return (boolean) preg_match('/^([a-z])+$/i', $value);
    }

    private function alpha_numeric($value)
    {
        if (function_exists('ctype_alnum')) {
            return ctype_alnum((string) $value);
        }

        return (boolean) preg_match('/^([a-z0-9])+$/i', $value);
    }

    private function alpha_numeric_spaces($value)
    {
        return (boolean) preg_match('/^[A-Z0-9 ]+$/i', $value);
    }

    private function alpha_dash($value)
    {
        return (boolean) preg_match('/^([-a-z0-9_-])+$/i', $value);
    }

    private function base64($value)
    {
        return (base64_encode(base64_decode($value)) === $value);
    }

    private function url($value)
    {
        if (empty($value)) {
            return false;
        } elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $value, $matches)) {
            if (empty($matches[2])) {
                return false;
            } elseif (! in_array($matches[1], ['http', 'https'], true)) {
                return false;
            }
            $value = $matches[2];
        }
        $value = 'http://'.$value;
        if (version_compare(PHP_VERSION, '5.2.13', '==') || version_compare(PHP_VERSION, '5.3.2', '==')) {
            sscanf($value, 'http://%[^/]', $host);
            $value = substr_replace($value, strtr($host, ['_' => '-', '-' => '_']), 7, strlen($host));
        }

        return (filter_var($value, FILTER_VALIDATE_URL) !== false);
    }

    private function match($value, $key = '')
    {
        $request = request('ALL');
        if (! array_key_exists($key, $request)) {
            return false;
        }
        if ($value === $request[$key]) {
            return true;
        }

        return false;
    }
}
