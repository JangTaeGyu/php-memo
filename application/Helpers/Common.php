<?php

/**
 * HTML 허용 태그 정의
 * @param  string $value [Value]
 * @return string
 */
function tagAllowable($value = '')
{
    $allowable = '<div><p><span><a><br><b><font><u><b><ul><ol><li><dl><dt><dd><img><strong><table><caption><colgroup><col><tbody><tr><td>';

    return strip_tags($value, $allowable);
}
