<?php

/**
 * 토큰 발행
 * @return string
 */
function token()
{
    return \Csrf::generate();
}
