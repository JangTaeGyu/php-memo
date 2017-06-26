<?php

/**
 * 템플릿 파일 확인
 * @param  string  $template [Path]
 * @return boolean
 */
function isTemplate($template = '')
{
    $path = TEMPLATE_PATH . '/' . $template;
    if (is_file($path)) {
        return $path;
    }

    return false;
}

/**
 * 뷰 파일 로드
 * @param  string $template [Path]
 * @param  array  $data     [Arguments]
 * @return string
 */
function view($template = '', array $data = [])
{
    if (isTemplate($template)) {
        ob_start();

        if (count($data) > 0) extract($data);

        include isTemplate($template);

        return ob_get_clean();
    }

    return new \Exception("{$template} 파일을 찾을 수 없습니다.");
}

/**
 * Json 형식 노출
 * @param  array  $data    [Data]
 * @param  string $charset [Charset]
 * @return string
 */
function json(array $data = [], $charset = 'UTF-8')
{
    header("Content-type: application/json; charset={$charset}");

    ob_start();

    echo json_encode($data);

    return ob_get_clean();
}

/**
 * Redirect
 * @param  string $target [Target]
 * @return void
 */
function redirect($target = '')
{
    if ($target === '') {
        $target = APP_URL;
    }

    header("Location: {$target}");
    die;
}
