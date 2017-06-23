<?php

namespace App\Libraries\Rules;

trait TokenCheckTrait
{
    private function token_check($value)
    {
        return \Csrf::check($value);
    }
}
